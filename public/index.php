<?php
<<<<<<< HEAD
// Activer l'affichage des erreurs temporairement
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

// Configuration et routes
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/routes/web.php';
=======
ob_start(); // Démarrer le buffer de sortie
require_once __DIR__ . '/../vendor/autoload.php';

// Configuration
require_once __DIR__ . '/../app/config/config.php';

// Configuration du chemin des vues
Flight::set('flight.views.path', __DIR__ . '/../app/views');

// Routes
require_once __DIR__ . '/../app/config/web.php';
>>>>>>> b-tiavina1

Flight::start();
