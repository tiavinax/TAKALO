<?php
class HistoriqueGlobalController {
    private $echangeModel;
    
    public function __construct() {
        $this->echangeModel = new EchangeModel();
    }
    
    public function showHistoriqueGlobal() {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }
        
        $historique = $this->echangeModel->getHistoriqueGlobal();
        
        // Vérifier que la vue existe
        $viewPath = __DIR__ . '/../views/historique/global.php';
        if (!file_exists($viewPath)) {
            die("❌ Vue introuvable : $viewPath");
        }
        
        Flight::render('historique/global', [
            'title' => '📜 Historique global - Takalo-takalo',
            'historique' => $historique
        ]);
    }
}
