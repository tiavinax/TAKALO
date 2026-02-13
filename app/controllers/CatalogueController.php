<?php
class CatalogueController {
    private $objetModel;
    private $echangeModel;
    private $categorieModel;
    
    public function __construct() {
        $this->objetModel = new ObjetModel();
        $this->echangeModel = new EchangeModel();
        $this->categorieModel = new CategorieModel();
    }
    
    /**
     * Affiche le catalogue avec recherche et filtre
     */
    public function showCatalogue() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les paramètres de recherche
        $search = $_GET['search'] ?? '';
        $categorie_id = $_GET['categorie_id'] ?? '';
        
        // Récupérer les objets avec filtres
        $objets = $this->objetModel->getAllExcludingUser(
            $_SESSION['user_id'], 
            $search, 
            $categorie_id
        );
        
        // Récupérer toutes les catégories pour le filtre
        $categories = $this->categorieModel->getAll();
        
        // Récupérer le nom de la catégorie sélectionnée
        $categorie_selectionnee = null;
        if ($categorie_id) {
            $categorie_selectionnee = $this->categorieModel->getById($categorie_id);
        }
        
        Flight::render('catalogue/liste', [
            'title' => '🎪 Catalogue - Takalo-takalo',
            'objets' => $objets,
            'categories' => $categories,
            'search' => $search,
            'categorie_id' => $categorie_id,
            'categorie_selectionnee' => $categorie_selectionnee
        ]);
    }
    
    /**
     * Affiche le détail d'un objet
     */
    public function showDetailObjet($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $objet = $this->objetModel->getById($id);
        
        if (!$objet) {
            Flight::redirect('/catalogue');
            return;
        }
        
        $photos = $this->objetModel->getPhotos($id);
        $mesObjets = $this->objetModel->getByUtilisateur($_SESSION['user_id']);
        
        Flight::render('catalogue/detail', [
            'title' => $objet['titre'] . ' - Takalo-takalo',
            'objet' => $objet,
            'photos' => $photos,
            'mesObjets' => $mesObjets
        ]);
    }
    
    /**
     * Propose un échange
     */
    public function proposerEchange() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $data = Flight::request()->data;
        
        // Vérifier que l'objet proposé appartient à l'utilisateur
        $objetPropose = $this->objetModel->getById($data->objet_propose_id);
        if ($objetPropose['utilisateur_id'] != $_SESSION['user_id']) {
            Flight::json(['error' => 'Tu ne possèdes pas cet objet'], 403);
            return;
        }
        
        // Vérifier que l'objet demandé n'appartient pas à l'utilisateur
        $objetDemande = $this->objetModel->getById($data->objet_demande_id);
        if ($objetDemande['utilisateur_id'] == $_SESSION['user_id']) {
            Flight::json(['error' => 'Tu ne peux pas échanger avec toi-même'], 400);
            return;
        }
        
        // Vérifier s'il n'y a pas déjà un échange en attente
        $echangeExistant = $this->echangeModel->verifierEchangeExistant(
            $data->objet_propose_id,
            $data->objet_demande_id
        );
        
        if ($echangeExistant) {
            Flight::json(['error' => 'Un échange est déjà en attente pour ces objets'], 400);
            return;
        }
        
        // Créer l'échange
        $success = $this->echangeModel->creer(
            $data->objet_propose_id,
            $data->objet_demande_id,
            $_SESSION['user_id']
        );
        
        if ($success) {
            Flight::json(['success' => true, 'message' => '✅ Proposition envoyée !']);
        } else {
            Flight::json(['error' => 'Erreur lors de la proposition'], 500);
        }
    }
    
    /**
     * Recherche AJAX (pour auto-complétion)
     */
    public function rechercherAjax() {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $search = $_GET['q'] ?? '';
        $categorie_id = $_GET['categorie_id'] ?? '';
        
        if (strlen($search) < 2) {
            Flight::json([]);
            return;
        }
        
        $objets = $this->objetModel->getAllExcludingUser(
            $_SESSION['user_id'],
            $search,
            $categorie_id
        );
        
        // Formater pour l'auto-complétion
        $resultats = [];
        foreach ($objets as $objet) {
            $resultats[] = [
                'id' => $objet['id'],
                'titre' => $objet['titre'],
                'prix' => $objet['prix_estimatif'],
                'proprietaire' => $objet['proprietaire_nom'],
                'categorie' => $objet['categorie_nom'] ?? 'Autre',
                'icone' => $objet['categorie_icone'] ?? '📦'
            ];
        }
        
        Flight::json($resultats);
    }
}
