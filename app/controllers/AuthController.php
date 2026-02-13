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
<<<<<<< HEAD
        try {
            $data = Flight::request()->data;
            
            // Validation
            if (empty($data->nom) || empty($data->email) || empty($data->password)) {
                Flight::json(['error' => 'Tous les champs sont obligatoires'], 400);
                return;
            }
            
            if ($data->password !== $data->confirm_password) {
                Flight::json(['error' => 'Les mots de passe ne correspondent pas'], 400);
                return;
            }
            
            // Vérifier si l'email existe déjà
            if ($this->userModel->emailExists($data->email)) {
                Flight::json(['error' => 'Cet email est déjà utilisé'], 400);
                return;
            }
            
            // Créer l'utilisateur
            $userId = $this->userModel->inscrire($data->nom, $data->email, $data->password);
            
            if ($userId) {
                // Récupérer l'utilisateur créé
                $user = $this->userModel->getById($userId);
                
                // Démarrer la session si pas déjà fait
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                // Connecter l'utilisateur
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                
                Flight::json([
                    'success' => true, 
                    'message' => 'Inscription réussie !',
                    'redirect' => BASE_URL . '/mes-objets',
                    'user_id' => $userId
                ]);
            } else {
                Flight::json(['error' => 'Erreur lors de la création du compte'], 500);
            }
            
        } catch (Exception $e) {
            Flight::json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
=======
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
>>>>>>> b-tiavina1
        }
    }
    
    public function showLogin() {
        Flight::render('auth/login', ['title' => 'Connexion']);
    }
    
    public function login() {
<<<<<<< HEAD
        try {
            $data = Flight::request()->data;
            
            if (empty($data->email) || empty($data->password)) {
                Flight::json(['error' => 'Email et mot de passe requis'], 400);
                return;
            }
            
            $user = $this->userModel->verifierLogin($data->email, $data->password);
            
            if ($user) {
                // Démarrer la session si pas déjà fait
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                
                // Debug log
                error_log("Connexion réussie pour user_id: " . $user['id']);
                
                Flight::json([
                    'success' => true, 
                    'redirect' => BASE_URL . '/mes-objets',
                    'user' => [
                        'id' => $user['id'],
                        'nom' => $user['nom']
                    ]
                ]);
            } else {
                Flight::json(['error' => 'Email ou mot de passe incorrect'], 401);
            }
            
        } catch (Exception $e) {
            Flight::json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
=======
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
>>>>>>> b-tiavina1
        }
    }
    
    public function logout() {
<<<<<<< HEAD
        session_destroy();
        session_start();
        session_regenerate_id(true);
        Flight::redirect('/login');
    }
}
=======
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
>>>>>>> b-tiavina1
