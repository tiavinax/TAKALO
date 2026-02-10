<?php
class EchangeController {
    private $echangeModel;
    
    public function __construct() {
        $this->echangeModel = new EchangeModel();
    }
    
    public function showMesEchanges() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $echanges = $this->echangeModel->getByUtilisateur($_SESSION['user_id']);
        
        Flight::render('echanges/liste', [
            'title' => 'Mes échanges',
            'echanges' => $echanges
        ]);
    }
    
    public function accepterEchange($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $success = $this->echangeModel->accepter($id, $_SESSION['user_id']);
        
        if ($success) {
            Flight::json(['success' => true, 'message' => 'Échange accepté avec succès']);
        } else {
            Flight::json(['error' => 'Erreur lors de l\'acceptation de l\'échange'], 500);
        }
    }
    
    public function refuserEchange($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $success = $this->echangeModel->refuser($id, $_SESSION['user_id']);
        
        if ($success) {
            Flight::json(['success' => true, 'message' => 'Échange refusé']);
        } else {
            Flight::json(['error' => 'Erreur lors du refus de l\'échange'], 500);
        }
    }
    
    public function annulerEchange($id) {
        if (!isset($_SESSION['user_id'])) {
            Flight::json(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $success = $this->echangeModel->annuler($id, $_SESSION['user_id']);
        
        if ($success) {
            Flight::json(['success' => true, 'message' => 'Échange annulé']);
        } else {
            Flight::json(['error' => 'Erreur lors de l\'annulation de l\'échange'], 500);
        }
    }
}