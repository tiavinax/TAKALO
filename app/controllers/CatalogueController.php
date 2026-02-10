<?php
class CatalogueController {
    private $objetModel;
    private $echangeModel;
    
    public function __construct() {
        $this->objetModel = new ObjetModel();
        $this->echangeModel = new EchangeModel();
    }
    
    public function showCatalogue() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $objets = $this->objetModel->getAllExcludingUser($_SESSION['user_id']);
        
        Flight::render('catalogue/liste', [
            'title' => 'Catalogue des objets',
            'objets' => $objets
        ]);
    }
    
    public function showDetailObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $objet = $this->objetModel->getById($id);
        $photos = $this->objetModel->getPhotos($id);
        
        // Objets de l'utilisateur pour proposition d'échange
        $mesObjets = $this->objetModel->getByUtilisateur($_SESSION['user_id']);
        
        Flight::render('catalogue/detail', [
            'title' => $objet['titre'],
            'objet' => $objet,
            'photos' => $photos,
            'mesObjets' => $mesObjets
        ]);
    }
    
    public function proposerEchange() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
        
        // Vérifier que l'objet proposé appartient bien à l'utilisateur
        $objetPropose = $this->objetModel->getById($data->objet_propose_id);
        if ($objetPropose['utilisateur_id'] != $_SESSION['user_id']) {
            Flight::json(['error' => 'Vous ne possédez pas cet objet'], 403);
            return;
        }
        
        // Vérifier que l'objet demandé n'appartient pas à l'utilisateur
        $objetDemande = $this->objetModel->getById($data->objet_demande_id);
        if ($objetDemande['utilisateur_id'] == $_SESSION['user_id']) {
            Flight::json(['error' => 'Vous ne pouvez pas échanger avec vous-même'], 400);
            return;
        }
        
        // Vérifier s'il n'y a pas déjà un échange en attente
        $echangeExistant = $this->echangeModel->verifierEchangeExistant(
            $data->objet_propose_id,
            $data->objet_demande_id
        );
        
        if ($echangeExistant) {
            Flight::json(['error' => 'Un échange a déjà été proposé pour ces objets'], 400);
            return;
        }
        
        // Créer l'échange
        $success = $this->echangeModel->creer(
            $data->objet_propose_id,
            $data->objet_demande_id,
            $_SESSION['user_id']
        );
        
        if ($success) {
            Flight::json(['success' => true, 'message' => 'Échange proposé avec succès']);
        } else {
            Flight::json(['error' => 'Erreur lors de la proposition d\'échange'], 500);
        }
    }
}