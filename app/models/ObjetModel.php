<?php
class ObjetModel {
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
=======
        $this->db = Flight::db();
    }
    
    /**
     * Crée un nouvel objet avec catégorie
     */
    public function creer($utilisateur_id, $titre, $description, $prix_estimatif, $categorie_id = 1) {
        $sql = "INSERT INTO objets (utilisateur_id, titre, description, prix_estimatif, categorie_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$utilisateur_id, $titre, $description, $prix_estimatif, $categorie_id]);
        return $this->db->lastInsertId();
    }
    
    /**
     * Ajoute une photo
     */
    public function ajouterPhoto($objet_id, $chemin, $est_principale = false) {
        $sql = "INSERT INTO photos_objet (objet_id, chemin, est_principale) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$objet_id, $chemin, $est_principale]);
    }
    
    /**
     * Récupère les objets d'un utilisateur avec catégorie
     */
    public function getByUtilisateur($utilisateur_id) {
        $sql = "SELECT o.*, 
                c.nom as categorie_nom, 
                c.icone as categorie_icone,
                (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                FROM objets o 
                LEFT JOIN categories c ON o.categorie_id = c.id
                WHERE o.utilisateur_id = ?
                ORDER BY o.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère un objet par son ID avec catégorie
     */
    public function getById($id) {
        $sql = "SELECT o.*, u.nom as proprietaire_nom, u.email as proprietaire_email,
                c.id as categorie_id, c.nom as categorie_nom, c.icone as categorie_icone,
                (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                FROM objets o 
                JOIN utilisateurs u ON o.utilisateur_id = u.id
                LEFT JOIN categories c ON o.categorie_id = c.id
                WHERE o.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère tous les objets sauf ceux de l'utilisateur avec recherche et filtre
     */
    public function getAllExcludingUser($utilisateur_id, $search = '', $categorie_id = null) {
        $sql = "SELECT o.*, u.nom as proprietaire_nom,
                c.nom as categorie_nom, c.icone as categorie_icone,
                (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                FROM objets o 
                JOIN utilisateurs u ON o.utilisateur_id = u.id
                LEFT JOIN categories c ON o.categorie_id = c.id
                WHERE o.utilisateur_id != ?";
        
        $params = [$utilisateur_id];
        
        // Recherche par mot-clé
        if (!empty($search)) {
            $sql .= " AND (o.titre LIKE ? OR o.description LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        
        // Filtre par catégorie (sauf si "Tous" ou null)
        if (!empty($categorie_id) && $categorie_id != 1) {
            $sql .= " AND o.categorie_id = ?";
            $params[] = $categorie_id;
        }
        
        $sql .= " ORDER BY o.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère les photos d'un objet
     */
    public function getPhotos($objet_id) {
        $sql = "SELECT * FROM photos_objet WHERE objet_id = ? ORDER BY est_principale DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$objet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Met à jour un objet avec catégorie
     */
    public function update($id, $titre, $description, $prix_estimatif, $categorie_id = null) {
        $sql = "UPDATE objets SET titre = ?, description = ?, prix_estimatif = ?";
        $params = [$titre, $description, $prix_estimatif];
        
        if ($categorie_id) {
            $sql .= ", categorie_id = ?";
            $params[] = $categorie_id;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Supprime un objet
     */
    public function delete($id) {
        $sql = "DELETE FROM objets WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    /**
     * Récupère les objets par catégorie
     */
    public function getByCategorie($categorie_id, $utilisateur_id = null) {
        $sql = "SELECT o.*, u.nom as proprietaire_nom,
                (SELECT chemin FROM photos_objet WHERE objet_id = o.id AND est_principale = 1 LIMIT 1) as photo_principale
                FROM objets o 
                JOIN utilisateurs u ON o.utilisateur_id = u.id
                WHERE o.categorie_id = ?";
        
        $params = [$categorie_id];
        
        if ($utilisateur_id) {
            $sql .= " AND o.utilisateur_id != ?";
            $params[] = $utilisateur_id;
        }
        
        $sql .= " ORDER BY o.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> b-tiavina1
    }
}
