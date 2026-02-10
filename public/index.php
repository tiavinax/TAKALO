<?php
// Activer l'affichage des erreurs temporairement
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

// Configuration et routes
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/routes/web.php';

Flight::start();
