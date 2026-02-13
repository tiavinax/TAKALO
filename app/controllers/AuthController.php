<?php
class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UtilisateurModel();
    }
    
    public function showRegister() {
        Flight::render('auth/register', ['title' => 'Inscription']);
    }
    
    public function register() {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        $error = null;
        
        if ($password !== $confirm_password) {
            $error = 'Les mots de passe ne correspondent pas';
        } elseif (strlen($password) < 6) {
            $error = 'Le mot de passe doit contenir au moins 6 caractères';
        } elseif ($this->userModel->emailExists($email)) {
            $error = 'Cet email est déjà utilisé';
        }
        
        if ($error) {
            Flight::render('auth/register', [
                'title' => 'Inscription',
                'error' => $error,
                'old_nom' => $nom,
                'old_email' => $email
            ]);
            return;
        }
        
        if ($this->userModel->inscrire($nom, $email, $password)) {
            Flight::render('auth/login', [
                'title' => 'Connexion',
                'success' => 'Inscription réussie ! Tu peux maintenant te connecter.'
            ]);
        } else {
            Flight::render('auth/register', [
                'title' => 'Inscription',
                'error' => 'Erreur lors de l\'inscription',
                'old_nom' => $nom,
                'old_email' => $email
            ]);
        }
    }
    
    public function showLogin() {
        Flight::render('auth/login', ['title' => 'Connexion']);
    }
    
    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $user = $this->userModel->verifierLogin($email, $password);
        
        if ($user) {
            // Démarrer la session si pas déjà démarrée
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom'];
            $_SESSION['user_email'] = $user['email'];
            
            Flight::redirect('/mes-objets');
        } else {
            Flight::render('auth/login', [
                'title' => 'Connexion',
                'error' => 'Email ou mot de passe incorrect',
                'old_email' => $email
            ]);
        }
    }
    
    public function logout() {
        // Vérifier si une session existe avant de la détruire
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        
        // Supprimer les variables de session
        $_SESSION = [];
        
        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        Flight::redirect('/login');
    }
}
