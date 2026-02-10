<?php
// Charger les modèles et contrôleurs
require_once __DIR__ . '/../models/UtilisateurModel.php';
require_once __DIR__ . '/../models/ObjetModel.php';
require_once __DIR__ . '/../models/EchangeModel.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ObjetController.php';
require_once __DIR__ . '/../controllers/CatalogueController.php';
require_once __DIR__ . '/../controllers/EchangeController.php';

// Instanciation des contrôleurs
$authController = new AuthController();
$objetController = new ObjetController();
$catalogueController = new CatalogueController();
$echangeController = new EchangeController();

// Routes publiques
Flight::route('GET /', function() {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        Flight::redirect('/mes-objets');
    } else {
        // Afficher la page d'accueil publique
        Flight::render('home', ['title' => 'Accueil - Takalo-takalo']);
    }
});

// Route /mes-objets DOIT vérifier la session
Flight::route('GET /mes-objets', function() use ($objetController) {
    // Vérification STRICTE de la session
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        Flight::redirect('/login');
        exit;
    }
    $objetController->showMesObjets();
});

Flight::route('GET /login', [$authController, 'showLogin']);
Flight::route('POST /login', [$authController, 'login']);
Flight::route('GET /register', [$authController, 'showRegister']);
Flight::route('POST /register', [$authController, 'register']);

// Routes protégées
Flight::route('GET /logout', [$authController, 'logout']);

// Middleware pour vérifier l'authentification
Flight::map('requireAuth', function() {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        Flight::redirect('/login');
        return false;
    }
    return true;
});

// Routes objets (nécessitent une authentification)
Flight::route('GET /mes-objets', function() use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $objetController->showMesObjets();
});

Flight::route('GET /ajouter-objet', function() use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $objetController->showAjouterObjet();
});

Flight::route('POST /ajouter-objet', function() use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $objetController->ajouterObjet();
});

Flight::route('GET /modifier-objet/@id', function($id) use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $objetController->showModifierObjet($id);
});

Flight::route('POST /modifier-objet/@id', function($id) use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $objetController->updateObjet($id);
});

Flight::route('POST /supprimer-objet/@id', function($id) use ($objetController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $objetController->deleteObjet($id);
});

// Routes catalogue
Flight::route('GET /catalogue', function() use ($catalogueController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $catalogueController->showCatalogue();
});

Flight::route('GET /objet/@id', function($id) use ($catalogueController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $catalogueController->showDetailObjet($id);
});

Flight::route('POST /proposer-echange', function() use ($catalogueController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $catalogueController->proposerEchange();
});

// Routes échanges
Flight::route('GET /mes-echanges', function() use ($echangeController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return;
    }
    $echangeController->showMesEchanges();
});

Flight::route('POST /accepter-echange/@id', function($id) use ($echangeController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $echangeController->accepterEchange($id);
});

Flight::route('POST /refuser-echange/@id', function($id) use ($echangeController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $echangeController->refuserEchange($id);
});

Flight::route('POST /annuler-echange/@id', function($id) use ($echangeController) {
    if (!isset($_SESSION['user_id'])) {
        Flight::json(['error' => 'Non authentifié'], 401);
        return;
    }
    $echangeController->annulerEchange($id);
});

// Route pour les erreurs 404
Flight::map('notFound', function() {
    Flight::render('layout', [
        'title' => 'Page non trouvée',
        'content' => '
            <div class="container text-center py-5">
                <h1 class="display-1 text-muted">404</h1>
                <h2 class="mb-4">Page non trouvée</h2>
                <p class="lead">La page que vous recherchez n\'existe pas ou a été déplacée.</p>
                <a href="' . BASE_URL . '" class="btn btn-primary mt-3">Retour à l\'accueil</a>
            </div>
        '
    ]);
});
Flight::route('GET /force-logout', function() {
    session_destroy();
    session_start();
    session_regenerate_id(true);
    Flight::redirect('/');
});
// Route pour tester la connexion (debug)
Flight::route('GET /debug/session', function() {
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
});

Flight::route('GET /debug/env', function() {
    echo '<pre>';
    echo 'BASE_URL: ' . BASE_URL . "\n";
    echo 'Session ID: ' . session_id() . "\n";
    echo '</pre>';
});
if (defined('DEBUG') && DEBUG) {
    require_once __DIR__ . '/debug.php';
}