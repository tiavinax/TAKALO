<?php
class EchangeModel {
    private $db;
    
    public function __construct() {
<<<<<<< HEAD
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
=======
        $this->db = Flight::db();
    }
    
    /**
     * Crée une proposition d'échange
     */
    public function creer($objet_propose_id, $objet_demande_id, $propose_par) {
        $sql = "INSERT INTO echanges (objet_propose_id, objet_demande_id, propose_par, statut) 
                VALUES (?, ?, ?, 'en_attente')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$objet_propose_id, $objet_demande_id, $propose_par]);
    }
    
    /**
     * Vérifie si un échange existe déjà
     */
    public function verifierEchangeExistant($objet_propose_id, $objet_demande_id) {
        $sql = "SELECT COUNT(*) as count FROM echanges 
                WHERE ((objet_propose_id = ? AND objet_demande_id = ?) 
                OR (objet_propose_id = ? AND objet_demande_id = ?))
                AND statut = 'en_attente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$objet_propose_id, $objet_demande_id, $objet_demande_id, $objet_propose_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    
    /**
     * Récupère les échanges d'un utilisateur
     */
    public function getByUtilisateur($utilisateur_id) {
        $sql = "SELECT 
                    e.*,
                    op.id as objet_propose_id,
                    op.titre as objet_propose_titre,
                    op.utilisateur_id as proprietaire_propose_id,
                    od.id as objet_demande_id,
                    od.titre as objet_demande_titre,
                    od.utilisateur_id as proprietaire_demande_id,
                    up.id as propose_par_id,
                    up.nom as propose_par_nom,
                    ud.id as proprietaire_demande_user_id,
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
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($results as &$echange) {
            $echange['proprietaire_demande_id'] = $echange['proprietaire_demande_id'] ?? $echange['proprietaire_demande_user_id'] ?? null;
        }
        
        return $results;
    }
    
    /**
     * Récupère un échange par son ID
     */
    public function getById($id) {
        $sql = "SELECT 
                    e.*,
                    op.id as objet_propose_id,
                    op.titre as objet_propose_titre,
                    op.utilisateur_id as proprietaire_propose_id,
                    od.id as objet_demande_id,
                    od.titre as objet_demande_titre,
                    od.utilisateur_id as proprietaire_demande_id,
                    up.id as propose_par_id,
                    up.nom as propose_par_nom,
                    ud.id as proprietaire_demande_user_id,
                    ud.nom as proprietaire_objet_demande_nom
                FROM echanges e
                JOIN objets op ON e.objet_propose_id = op.id
                JOIN objets od ON e.objet_demande_id = od.id
                JOIN utilisateurs up ON e.propose_par = up.id
                JOIN utilisateurs ud ON od.utilisateur_id = ud.id
                WHERE e.id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $echange = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($echange) {
            $echange['proprietaire_demande_id'] = $echange['proprietaire_demande_id'] ?? $echange['proprietaire_demande_user_id'] ?? null;
        }
        
        return $echange;
    }
    
    /**
     * Accepte un échange
     */
    public function accepter($echange_id, $utilisateur_id) {
        $echange = $this->getById($echange_id);
        
        if ($echange['proprietaire_demande_id'] != $utilisateur_id) {
            return false;
        }
        
        $this->db->beginTransaction();
        
        try {
>>>>>>> b-tiavina1
            $sql = "UPDATE echanges SET statut = 'accepte' WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$echange_id]);
            
<<<<<<< HEAD
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
=======
            $ancien_proprio_propose = $echange['proprietaire_propose_id'];
            $ancien_proprio_demande = $echange['proprietaire_demande_id'];
            
            $sql = "UPDATE objets SET utilisateur_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$echange['propose_par_id'], $echange['objet_demande_id']]);
            $stmt->execute([$ancien_proprio_demande, $echange['objet_propose_id']]);
            
            $sql_hist = "INSERT INTO historique_proprietaires 
                        (objet_id, ancien_proprietaire_id, nouveau_proprietaire_id, echange_id) 
                        VALUES (?, ?, ?, ?)";
            $stmt_hist = $this->db->prepare($sql_hist);
            
            $stmt_hist->execute([
                $echange['objet_propose_id'],
                $ancien_proprio_propose,
                $ancien_proprio_demande,
                $echange_id
            ]);
            
            $stmt_hist->execute([
                $echange['objet_demande_id'],
                $ancien_proprio_demande,
                $echange['propose_par_id'],
                $echange_id
            ]);
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollBack();
>>>>>>> b-tiavina1
            error_log("Erreur acceptation échange: " . $e->getMessage());
            return false;
        }
    }
    
<<<<<<< HEAD
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
=======
    /**
     * Refuse un échange
     */
    public function refuser($echange_id, $utilisateur_id) {
        $echange = $this->getById($echange_id);
        
        if ($echange['proprietaire_demande_id'] != $utilisateur_id) {
            return false;
        }
        
        $sql = "UPDATE echanges SET statut = 'refuse' WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$echange_id]);
    }
    
    /**
     * Annule un échange
     */
    public function annuler($echange_id, $utilisateur_id) {
        $echange = $this->getById($echange_id);
        
        if ($echange['propose_par_id'] != $utilisateur_id) {
            return false;
        }
        
        $sql = "UPDATE echanges SET statut = 'annule' WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$echange_id]);
    }
    
    /**
     * Récupère l'historique d'un objet
     */
    public function getHistoriqueObjet($objet_id) {
        $sql = "SELECT h.*,
                u1.nom as ancien_proprietaire_nom,
                u2.nom as nouveau_proprietaire_nom,
                e.created_at as date_echange
                FROM historique_proprietaires h
                JOIN utilisateurs u1 ON h.ancien_proprietaire_id = u1.id
                JOIN utilisateurs u2 ON h.nouveau_proprietaire_id = u2.id
                JOIN echanges e ON h.echange_id = e.id
                WHERE h.objet_id = ?
                ORDER BY h.date_echange DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$objet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère le propriétaire actuel
     */
    public function getProprietaireActuel($objet_id) {
        $sql = "SELECT u.id, u.nom, u.email
                FROM objets o
                JOIN utilisateurs u ON o.utilisateur_id = u.id
                WHERE o.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$objet_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère l'historique global de tous les échanges
     */
    public function getHistoriqueGlobal() {
        $sql = "SELECT 
                    h.*,
                    o.titre as objet_titre,
                    o.id as objet_id,
                    u1.nom as ancien_proprietaire_nom,
                    u2.nom as nouveau_proprietaire_nom,
                    e.created_at as date_echange,
                    c.icone as categorie_icone,
                    c.nom as categorie_nom,
                    (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo
                FROM historique_proprietaires h
                JOIN objets o ON h.objet_id = o.id
                JOIN utilisateurs u1 ON h.ancien_proprietaire_id = u1.id
                JOIN utilisateurs u2 ON h.nouveau_proprietaire_id = u2.id
                JOIN echanges e ON h.echange_id = e.id
                LEFT JOIN categories c ON o.categorie_id = c.id
                ORDER BY h.date_echange DESC
                LIMIT 50";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> b-tiavina1
    }
}
