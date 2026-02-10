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
        }
    }
    
    public function showLogin() {
        Flight::render('auth/login', ['title' => 'Connexion']);
    }
    
    public function login() {
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
        }
    }
    
    public function logout() {
        session_destroy();
        session_start();
        session_regenerate_id(true);
        Flight::redirect('/login');
    }
}