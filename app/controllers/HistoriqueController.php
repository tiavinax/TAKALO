<?php
class HistoriqueController {
    private $echangeModel;
    private $objetModel;
    
    public function __construct() {
        $this->echangeModel = new EchangeModel();
        $this->objetModel = new ObjetModel();
    }
    
    /**
     * Affiche l'historique d'un objet
     */
    public function showHistorique($objet_id) {
        // Pas besoin d'être connecté pour voir l'historique (public)
        
        $objet = $this->objetModel->getById($objet_id);
        
        if (!$objet) {
            Flight::redirect('/catalogue');
            return;
        }
        
        $historique = $this->echangeModel->getHistoriqueObjet($objet_id);
        $proprietaire_actuel = $this->echangeModel->getProprietaireActuel($objet_id);
        $photos = $this->objetModel->getPhotos($objet_id);
        
        Flight::render('objets/historique', [
            'title' => '📜 Historique - ' . $objet['titre'],
            'objet' => $objet,
            'historique' => $historique,
            'proprietaire_actuel' => $proprietaire_actuel,
            'photos' => $photos
        ]);
    }
}
