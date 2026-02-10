<?php
class ObjetModel {
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
    
    public function creer($utilisateur_id, $titre, $description, $prix_estimatif) {
        try {
            $sql = "INSERT INTO objets (utilisateur_id, titre, description, prix_estimatif) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$utilisateur_id, $titre, $description, $prix_estimatif]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur création objet: " . $e->getMessage());
            return false;
        }
    }
    
    public function ajouterPhoto($objet_id, $chemin, $est_principale = false) {
        try {
            $sql = "INSERT INTO photos_objet (objet_id, chemin, est_principale) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$objet_id, $chemin, $est_principale]);
        } catch (PDOException $e) {
            error_log("Erreur ajout photo: " . $e->getMessage());
            return false;
        }
    }
    
    public function getByUtilisateur($utilisateur_id) {
        try {
            $sql = "SELECT o.*, 
                    (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                    FROM objets o 
                    WHERE o.utilisateur_id = ?
                    ORDER BY o.created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$utilisateur_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération objets utilisateur: " . $e->getMessage());
            return [];
        }
    }
    
    public function getById($id) {
        try {
            $sql = "SELECT o.*, u.nom as proprietaire_nom, u.email as proprietaire_email,
                    (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                    FROM objets o 
                    JOIN utilisateurs u ON o.utilisateur_id = u.id
                    WHERE o.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération objet: " . $e->getMessage());
            return null;
        }
    }
    
    public function getAllExcludingUser($utilisateur_id) {
        try {
            $sql = "SELECT o.*, u.nom as proprietaire_nom,
                    (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                    FROM objets o 
                    JOIN utilisateurs u ON o.utilisateur_id = u.id
                    WHERE o.utilisateur_id != ?
                    ORDER BY o.created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$utilisateur_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération catalogue: " . $e->getMessage());
            return [];
        }
    }
    
    public function getPhotos($objet_id) {
        try {
            $sql = "SELECT * FROM photos_objet WHERE objet_id = ? ORDER BY est_principale DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$objet_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération photos: " . $e->getMessage());
            return [];
        }
    }
    
    public function update($id, $titre, $description, $prix_estimatif) {
        try {
            $sql = "UPDATE objets SET titre = ?, description = ?, prix_estimatif = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$titre, $description, $prix_estimatif, $id]);
        } catch (PDOException $e) {
            error_log("Erreur mise à jour objet: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete($id) {
        try {
            $sql = "DELETE FROM objets WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erreur suppression objet: " . $e->getMessage());
            return false;
        }
    }
}
