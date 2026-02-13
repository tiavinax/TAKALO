<?php
class CategorieModel {
    private $db;
    
    public function __construct() {
        $this->db = Flight::db();
    }
    
    /**
     * Récupère toutes les catégories
     */
    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY nom ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère les catégories pour le select (sauf "Tous" pour formulaire)
     */
    public function getForSelect() {
        $sql = "SELECT * FROM categories WHERE nom != 'Tous' ORDER BY nom ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère une catégorie par son ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère une catégorie par son nom
     */
    public function getByNom($nom) {
        $sql = "SELECT * FROM categories WHERE nom = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Ajoute une nouvelle catégorie (admin)
     */
    public function ajouter($nom, $icone = '📦', $description = '') {
        $sql = "INSERT INTO categories (nom, icone, description) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $icone, $description]);
    }
    
    /**
     * Modifie une catégorie (admin)
     */
    public function modifier($id, $nom, $icone, $description) {
        $sql = "UPDATE categories SET nom = ?, icone = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $icone, $description, $id]);
    }
    
    /**
     * Supprime une catégorie (admin)
     */
    public function supprimer($id) {
        // Vérifier si des objets utilisent cette catégorie
        $sql = "SELECT COUNT(*) as count FROM objets WHERE categorie_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            return false; // Catégorie utilisée
        }
        
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    /**
     * Récupère le nombre d'objets par catégorie
     */
    public function getNombreObjets($categorie_id = null) {
        if ($categorie_id) {
            $sql = "SELECT COUNT(*) as count FROM objets WHERE categorie_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$categorie_id]);
        } else {
            $sql = "SELECT c.id, c.nom, c.icone, COUNT(o.id) as total 
                    FROM categories c 
                    LEFT JOIN objets o ON c.id = o.categorie_id 
                    GROUP BY c.id 
                    ORDER BY total DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
