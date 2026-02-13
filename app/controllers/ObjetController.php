<?php
class ObjetController {
    private $objetModel;
    private $categorieModel;
    
    public function __construct() {
        $this->objetModel = new ObjetModel();
        $this->categorieModel = new CategorieModel();
    }
    
    public function showMesObjets() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $objets = $this->objetModel->getByUtilisateur($_SESSION['user_id']);
        Flight::render('objets/mes-objets', [
            'title' => '📦 Mes objets - Takalo-takalo',
            'objets' => $objets
        ]);
    }
    
    public function showAjouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $categories = $this->categorieModel->getForSelect();
        Flight::render('objets/ajouter', [
            'title' => '✨ Ajouter un objet - Takalo-takalo',
            'categories' => $categories
        ]);
    }
    
    public function ajouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
        $categorie_id = $data->categorie_id ?? 1;
        
        $objet_id = $this->objetModel->creer(
            $_SESSION['user_id'],
            $data->titre,
            $data->description,
            $data->prix_estimatif,
            $categorie_id
        );
        
        // Gestion des photos
        if (isset($_FILES['photos'])) {
            $this->uploadPhotos($objet_id, $_FILES['photos']);
        }
        
        Flight::json(['success' => true, 'objet_id' => $objet_id]);
    }
    
    private function uploadPhotos($objet_id, $files) {
        $uploadDir = __DIR__ . '/../../public/assets/images/';
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $fileName = 'objet_' . $objet_id . '_' . time() . '_' . $i . '.' . $extension;
                $filePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($files['tmp_name'][$i], $filePath)) {
                    $this->objetModel->ajouterPhoto(
                        $objet_id, 
                        $fileName, 
                        $i === 0
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
        
        if ($objet['utilisateur_id'] != $_SESSION['user_id']) {
            Flight::redirect('/mes-objets');
            return;
        }
        
        $photos = $this->objetModel->getPhotos($id);
        $categories = $this->categorieModel->getForSelect();
        
        Flight::render('objets/modifier', [
            'title' => '✏️ Modifier - Takalo-takalo',
            'objet' => $objet,
            'photos' => $photos,
            'categories' => $categories
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
            $data->prix_estimatif,
            $data->categorie_id ?? null
        );
        
        Flight::json(['success' => $success]);
    }
    
    public function deleteObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $photos = $this->objetModel->getPhotos($id);
        
        foreach ($photos as $photo) {
            $filePath = __DIR__ . '/../../public/assets/images/' . $photo['chemin'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $success = $this->objetModel->delete($id);
        Flight::json(['success' => $success]);
    }
}
