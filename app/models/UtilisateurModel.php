<?php
class UtilisateurModel {
    private $db;
    
    public function __construct() {
        $this->db = Flight::db();
    }
    
    public function inscrire($nom, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $email, $hash]);
    }
    
    public function verifierLogin($email, $password) {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
<<<<<<< HEAD
            // Ne pas renvoyer le mot de passe
=======
>>>>>>> b-tiavina1
            unset($user['password']);
            return $user;
        }
        return false;
    }
    
    public function getByEmail($email) {
<<<<<<< HEAD
        $sql = "SELECT id, email FROM utilisateurs WHERE email = ?";
=======
        $sql = "SELECT id, nom, email, created_at FROM utilisateurs WHERE email = ?";
>>>>>>> b-tiavina1
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
<<<<<<< HEAD
   public function emailExists($email) {
    $sql = "SELECT COUNT(*) as count FROM utilisateurs WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}
=======
    
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM utilisateurs WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
>>>>>>> b-tiavina1

    public function getById($id) {
        $sql = "SELECT id, nom, email, created_at FROM utilisateurs WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
<<<<<<< HEAD
=======
    
    /**
     * Mettre à jour le profil utilisateur
     */
    public function updateProfil($id, $nom, $email) {
        $sql = "UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $email, $id]);
    }
    
    /**
     * Changer le mot de passe
     */
    public function updatePassword($id, $new_password) {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE utilisateurs SET password = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$hash, $id]);
    }
    
    /**
     * Vérifier l'ancien mot de passe
     */
    public function verifyPassword($id, $password) {
        $sql = "SELECT password FROM utilisateurs WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
>>>>>>> b-tiavina1
}
