<?php
/**
 * Autoloader simple pour le projet Takalo-takalo
 */
spl_autoload_register(function ($class_name) {
    // Liste des répertoires à chercher
    $directories = [
        __DIR__ . '/models/',
        __DIR__ . '/controllers/',
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Inclure les modèles essentiels
require_once __DIR__ . '/models/UtilisateurModel.php';
require_once __DIR__ . '/models/ObjetModel.php';
require_once __DIR__ . '/models/EchangeModel.php';

// Inclure les contrôleurs
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ObjetController.php';
require_once __DIR__ . '/controllers/CatalogueController.php';
require_once __DIR__ . '/controllers/EchangeController.php';
