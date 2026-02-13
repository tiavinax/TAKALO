<?php
ob_start(); // Démarrer le buffer de sortie
require_once __DIR__ . '/../vendor/autoload.php';

// Configuration
require_once __DIR__ . '/../app/config/config.php';

// Configuration du chemin des vues
Flight::set('flight.views.path', __DIR__ . '/../app/views');

// Routes
require_once __DIR__ . '/../app/config/web.php';

Flight::start();
