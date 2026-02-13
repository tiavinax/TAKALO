<?php
// Inclure les modèles nécessaires
require_once __DIR__ . '/../models/UtilisateurModel.php';
require_once __DIR__ . '/../models/ObjetModel.php';
require_once __DIR__ . '/../models/EchangeModel.php';

class ProfilController {
    private $utilisateurModel;
    private $objetModel;
    private $echangeModel;
    
    public function __construct() {
        $this->utilisateurModel = new UtilisateurModel();
        $this->objetModel = new ObjetModel();
        $this->echangeModel = new EchangeModel();
    }
    
    /**
     * Afficher la page de profil
     */
    public function showProfil() {
        ob_clean();
        
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $utilisateur = $this->utilisateurModel->getById($_SESSION['user_id']);
        
        if (!$utilisateur) {
            Flight::redirect('/login');
            return;
        }
        
        $objets = $this->objetModel->getByUtilisateur($_SESSION['user_id']);
        $echanges = $this->echangeModel->getByUtilisateur($_SESSION['user_id']);
        
        // Compter les échanges réussis
        $echanges_reussis = 0;
        foreach ($echanges as $e) {
            if ($e['statut'] == 'accepte') {
                $echanges_reussis++;
            }
        }
        
        Flight::render('profil/index', [
            'title' => '👤 Mon profil - Takalo-takalo',
            'utilisateur' => $utilisateur,
            'objets' => $objets,
            'nb_objets' => count($objets),
            'nb_echanges' => $echanges_reussis,
            'membre_depuis' => date('d/m/Y', strtotime($utilisateur['created_at']))
        ]);
    }
    
    /**
     * Modifier le profil
     */
    public function showEditProfil() {
        ob_clean();
        
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $utilisateur = $this->utilisateurModel->getById($_SESSION['user_id']);
        
        Flight::render('profil/edit', [
            'title' => '✏️ Modifier mon profil - Takalo-takalo',
            'utilisateur' => $utilisateur
        ]);
    }
    
    /**
     * Mettre à jour le profil
     */
    public function updateProfil() {
        ob_clean();
        
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        
        if (empty($nom) || empty($email)) {
            Flight::redirect('/mon-profil?error=missing_fields');
            return;
        }
        
        // Vérifier si l'email est déjà utilisé par quelqu'un d'autre
        $existing = $this->utilisateurModel->getByEmail($email);
        if ($existing && $existing['id'] != $_SESSION['user_id']) {
            Flight::redirect('/mon-profil?error=email_exists');
            return;
        }
        
        $success = $this->utilisateurModel->updateProfil($_SESSION['user_id'], $nom, $email);
        
        if ($success) {
            $_SESSION['user_name'] = $nom;
            Flight::redirect('/mon-profil?success=profile_updated');
        } else {
            Flight::redirect('/mon-profil?error=update_failed');
        }
    }
}
