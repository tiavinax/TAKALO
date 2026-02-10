<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// Configuration MAMP - MOT DE PASSE VIDE
$socket = '/Applications/MAMP/tmp/mysql/mysql.sock';
$dbname = 'takalo_takalo';
$user = 'root';
$password = ''; // MOT DE PASSE VIDE

// Session DOIT ÊTRE DÉMARRÉE AVANT TOUT
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mode debug - mettre à false pour cacher les messages
define('DEBUG', false); // ← CHANGER À false POUR CACHER LE DEBUG
define('BASE_URL', 'http://localhost:8000');

// Configuration de la base de données
try {
    $dsn = "mysql:unix_socket=$socket;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    
    // Enregistrer la connexion
    Flight::register('db', 'PDO', 
        array($dsn, $user, $password),
        function($db) {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
    );
    
} catch (PDOException $e) {
    // Afficher une erreur propre même sans debug
    die("<h2>Erreur de connexion à la base de données</h2>
         <p>Veuillez vérifier que MAMP est démarré et que MySQL fonctionne.</p>
         <p><em>Détails techniques (admin) : " . htmlspecialchars($e->getMessage()) . "</em></p>");
}

// Configuration des vues
$viewsPath = __DIR__ . '/../views';
Flight::set('flight.views.path', $viewsPath);

// Middleware pour vérifier l'authentification
Flight::map('requireAuth', function() {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return false;
    }
    return true;
});

// Configuration d'erreur
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    
    // Gérer les erreurs silencieusement
    Flight::map('error', function($ex) {
        // Logger l'erreur (vous pourriez écrire dans un fichier log)
        error_log('FlightPHP Error: ' . $ex->getMessage());
        
        // Afficher une page d'erreur propre
        Flight::render('layout', [
            'title' => 'Erreur',
            'content' => '
                <div class="container text-center py-5">
                    <h1 class="text-danger">Oops !</h1>
                    <p class="lead">Une erreur est survenue.</p>
                    <a href="' . BASE_URL . '" class="btn btn-primary">Retour à l\'accueil</a>
                </div>
            '
        ]);
    });
}
