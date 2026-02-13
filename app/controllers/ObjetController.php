<?php
class ObjetController {
    private $objetModel;
<<<<<<< HEAD
    
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
    
=======
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
    
>>>>>>> b-tiavina1
    public function showAjouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
<<<<<<< HEAD
        Flight::render('objets/ajouter', ['title' => 'Ajouter un objet']);
=======
        $categories = $this->categorieModel->getForSelect();
        Flight::render('objets/ajouter', [
            'title' => '✨ Ajouter un objet - Takalo-takalo',
            'categories' => $categories
        ]);
>>>>>>> b-tiavina1
    }
    
    public function ajouterObjet() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
<<<<<<< HEAD
=======
        $categorie_id = $data->categorie_id ?? 1;
        
>>>>>>> b-tiavina1
        $objet_id = $this->objetModel->creer(
            $_SESSION['user_id'],
            $data->titre,
            $data->description,
<<<<<<< HEAD
            $data->prix_estimatif
=======
            $data->prix_estimatif,
            $categorie_id
>>>>>>> b-tiavina1
        );
        
        // Gestion des photos
        if (isset($_FILES['photos'])) {
            $this->uploadPhotos($objet_id, $_FILES['photos']);
        }
        
        Flight::json(['success' => true, 'objet_id' => $objet_id]);
    }
    
    private function uploadPhotos($objet_id, $files) {
<<<<<<< HEAD
        $uploadDir = __DIR__ . '/../../public/assets/images/objets/';
        
        // Créer le dossier si n'existe pas
        if (!is_dir($uploadDir)) {
=======
        $uploadDir = __DIR__ . '/../../public/assets/images/';
        
        if (!file_exists($uploadDir)) {
>>>>>>> b-tiavina1
            mkdir($uploadDir, 0777, true);
        }
        
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
<<<<<<< HEAD
                $fileName = uniqid() . '_' . basename($files['name'][$i]);
=======
                $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $fileName = 'objet_' . $objet_id . '_' . time() . '_' . $i . '.' . $extension;
>>>>>>> b-tiavina1
                $filePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($files['tmp_name'][$i], $filePath)) {
                    $this->objetModel->ajouterPhoto(
                        $objet_id, 
                        $fileName, 
<<<<<<< HEAD
                        $i === 0 // Première photo est principale
=======
                        $i === 0
>>>>>>> b-tiavina1
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
        
<<<<<<< HEAD
        // Vérifier que l'utilisateur est propriétaire
=======
>>>>>>> b-tiavina1
        if ($objet['utilisateur_id'] != $_SESSION['user_id']) {
            Flight::redirect('/mes-objets');
            return;
        }
        
        $photos = $this->objetModel->getPhotos($id);
<<<<<<< HEAD
        
        Flight::render('objets/modifier', [
            'title' => 'Modifier l\'objet',
            'objet' => $objet,
            'photos' => $photos
=======
        $categories = $this->categorieModel->getForSelect();
        
        Flight::render('objets/modifier', [
            'title' => '✏️ Modifier - Takalo-takalo',
            'objet' => $objet,
            'photos' => $photos,
            'categories' => $categories
>>>>>>> b-tiavina1
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
<<<<<<< HEAD
            $data->prix_estimatif
=======
            $data->prix_estimatif,
            $data->categorie_id ?? null
>>>>>>> b-tiavina1
        );
        
        Flight::json(['success' => $success]);
    }
    
    public function deleteObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
<<<<<<< HEAD
=======
        $photos = $this->objetModel->getPhotos($id);
        
        foreach ($photos as $photo) {
            $filePath = __DIR__ . '/../../public/assets/images/' . $photo['chemin'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
>>>>>>> b-tiavina1
        $success = $this->objetModel->delete($id);
        Flight::json(['success' => $success]);
    }
}
