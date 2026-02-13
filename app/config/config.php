<?php
// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Construction du DSN
$dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];

// Ajout du socket si spécifié
if (!empty($_ENV['DB_SOCKET'])) {
    $dsn .= ';unix_socket=' . $_ENV['DB_SOCKET'];
}

// Configuration de la base de données
Flight::register('db', 'PDO', 
    array(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    ),
    function($db) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES utf8mb4");
    }
);

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Constantes
define('BASE_URL', $_ENV['BASE_URL'] ?? 'http://localhost:8000');
define('DEBUG', $_ENV['DEBUG'] ?? false);

// Middleware pour vérifier l'authentification
Flight::map('requireAuth', function() {
    if (!isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        return false;
    }
    return true;
});

// Configuration supplémentaire - Chemin des vues
Flight::set('flight.views.path', __DIR__ . '/../views');
