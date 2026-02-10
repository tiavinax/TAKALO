<?php
class EchangeModel {
    private $db;
    
    public function __construct() {
        try {
            $this->db = Flight::db();
        } catch (Exception $e) {
            if (DEBUG) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            } else {
                die("Erreur de connexion à la base de données");
            }
        }
    }
    
    public function creer($objet_propose_id, $objet_demande_id, $propose_par) {
        try {
            $sql = "INSERT INTO echanges (objet_propose_id, objet_demande_id, propose_par, statut) 
                    VALUES (?, ?, ?, 'en_attente')";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$objet_propose_id, $objet_demande_id, $propose_par]);
        } catch (PDOException $e) {
            error_log("Erreur création échange: " . $e->getMessage());
            return false;
        }
    }
    
    public function verifierEchangeExistant($objet_propose_id, $objet_demande_id) {
        try {
            $sql = "SELECT COUNT(*) as count FROM echanges 
                    WHERE ((objet_propose_id = ? AND objet_demande_id = ?) 
                    OR (objet_propose_id = ? AND objet_demande_id = ?))
                    AND statut = 'en_attente'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$objet_propose_id, $objet_demande_id, $objet_demande_id, $objet_propose_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            error_log("Erreur vérification échange: " . $e->getMessage());
            return false;
        }
    }
    
    public function getByUtilisateur($utilisateur_id) {
        try {
            $sql = "SELECT e.*, 
                    op.titre as objet_propose_titre,
                    od.titre as objet_demande_titre,
                    up.nom as propose_par_nom,
                    ud.nom as proprietaire_objet_demande_nom,
                    (SELECT chemin FROM photos_objet WHERE objet_id = op.id AND est_principale = 1 LIMIT 1) as photo_propose,
                    (SELECT chemin FROM photos_objet WHERE objet_id = od.id AND est_principale = 1 LIMIT 1) as photo_demande
                    FROM echanges e
                    JOIN objets op ON e.objet_propose_id = op.id
                    JOIN objets od ON e.objet_demande_id = od.id
                    JOIN utilisateurs up ON e.propose_par = up.id
                    JOIN utilisateurs ud ON od.utilisateur_id = ud.id
                    WHERE (e.propose_par = ? OR od.utilisateur_id = ?)
                    ORDER BY e.created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$utilisateur_id, $utilisateur_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération échanges: " . $e->getMessage());
            return [];
        }
    }
    
    public function getById($id) {
        try {
            $sql = "SELECT e.*, 
                    op.titre as objet_propose_titre,
                    od.titre as objet_demande_titre,
                    op.utilisateur_id as proprietaire_propose_id,
                    od.utilisateur_id as proprietaire_demande_id,
                    up.nom as propose_par_nom,
                    ud.nom as proprietaire_objet_demande_nom
                    FROM echanges e
                    JOIN objets op ON e.objet_propose_id = op.id
                    JOIN objets od ON e.objet_demande_id = od.id
                    JOIN utilisateurs up ON e.propose_par = up.id
                    JOIN utilisateurs ud ON od.utilisateur_id = ud.id
                    WHERE e.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération échange: " . $e->getMessage());
            return null;
        }
    }
    
    public function accepter($echange_id, $utilisateur_id) {
        try {
            $echange = $this->getById($echange_id);
            
            if (!$echange) {
                return false;
            }
            
            // Vérifier que l'utilisateur est bien le propriétaire de l'objet demandé
            if ($echange['proprietaire_demande_id'] != $utilisateur_id) {
                return false;
            }
            
            // Commencer une transaction
            $this->db->beginTransaction();
            
            // Mettre à jour le statut de l'échange
            $sql = "UPDATE echanges SET statut = 'accepte' WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$echange_id]);
            
            // Échanger les propriétaires des objets
            $sql = "UPDATE objets SET utilisateur_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            
            // L'objet demandé va au proposeur
            $stmt->execute([$echange['propose_par'], $echange['objet_demande_id']]);
            
            // L'objet proposé va au propriétaire de l'objet demandé
            $stmt->execute([$echange['proprietaire_demande_id'], $echange['objet_propose_id']]);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Erreur acceptation échange: " . $e->getMessage());
            return false;
        }
    }
    
    public function refuser($echange_id, $utilisateur_id) {
        try {
            $echange = $this->getById($echange_id);
            
            if (!$echange) {
                return false;
            }
            
            // Vérifier que l'utilisateur est bien le propriétaire de l'objet demandé
            if ($echange['proprietaire_demande_id'] != $utilisateur_id) {
                return false;
            }
            
            $sql = "UPDATE echanges SET statut = 'refuse' WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$echange_id]);
        } catch (PDOException $e) {
            error_log("Erreur refus échange: " . $e->getMessage());
            return false;
        }
    }
    
    public function annuler($echange_id, $utilisateur_id) {
        try {
            $echange = $this->getById($echange_id);
            
            if (!$echange) {
                return false;
            }
            
            // Vérifier que l'utilisateur est bien celui qui a proposé l'échange
            if ($echange['propose_par'] != $utilisateur_id) {
                return false;
            }
            
            $sql = "UPDATE echanges SET statut = 'annule' WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$echange_id]);
        } catch (PDOException $e) {
            error_log("Erreur annulation échange: " . $e->getMessage());
            return false;
        }
    }
}
