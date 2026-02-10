<?php
class ObjetController {
    private $objetModel;
    
    public function __construct() {
        require_once __DIR__ . '/../models/ObjetModel.php';
        $this->objetModel = new ObjetModel();
    }
    
   public function showMesObjets() {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    
    // DEBUG TEMPORAIRE
    echo "<!-- DEBUG: user_id = " . $_SESSION['user_id'] . " -->";
    echo "<!-- DEBUG: user_name = " . ($_SESSION['user_name'] ?? 'non défini') . " -->";
    
    $objets = $this->objetModel->getByUtilisateur($_SESSION['user_id']);
    
    // DEBUG TEMPORAIRE
    echo "<!-- DEBUG: Nombre d'objets trouvés = " . count($objets) . " -->";
    if (!empty($objets)) {
        echo "<!-- DEBUG: Premier objet = " . htmlspecialchars(print_r($objets[0], true)) . " -->";
    }
    
    Flight::render('objets/mes-objets', [
        'title' => 'Mes objets',
        'objets' => $objets
    ]);
}
    
    public function showAjouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        Flight::render('objets/ajouter', ['title' => 'Ajouter un objet']);
    }
    
    public function ajouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
        $objet_id = $this->objetModel->creer(
            $_SESSION['user_id'],
            $data->titre,
            $data->description,
            $data->prix_estimatif
        );
        
        // Gestion des photos
        if (isset($_FILES['photos'])) {
            $this->uploadPhotos($objet_id, $_FILES['photos']);
        }
        
        Flight::json(['success' => true, 'objet_id' => $objet_id]);
    }
    
    private function uploadPhotos($objet_id, $files) {
        $uploadDir = __DIR__ . '/../../public/assets/images/objets/';
        
        // Créer le dossier si n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . '_' . basename($files['name'][$i]);
                $filePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($files['tmp_name'][$i], $filePath)) {
                    $this->objetModel->ajouterPhoto(
                        $objet_id, 
                        $fileName, 
                        $i === 0 // Première photo est principale
                    );
                }
            }
        }
    }
    
    public function showModifierObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $objet = $this->objetModel->getById($id);
        
        // Vérifier que l'utilisateur est propriétaire
        if ($objet['utilisateur_id'] != $_SESSION['user_id']) {
            Flight::redirect('/mes-objets');
            return;
        }
        
        $photos = $this->objetModel->getPhotos($id);
        
        Flight::render('objets/modifier', [
            'title' => 'Modifier l\'objet',
            'objet' => $objet,
            'photos' => $photos
        ]);
    }
    
    public function updateObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
        $success = $this->objetModel->update(
            $id,
            $data->titre,
            $data->description,
            $data->prix_estimatif
        );
        
        Flight::json(['success' => $success]);
    }
    
    public function deleteObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $success = $this->objetModel->delete($id);
        Flight::json(['success' => $success]);
    }
}
