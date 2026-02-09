<?php
/**********************************************
 *      FlightPHP Skeleton Sample Config      *
 **********************************************
 *
 * Copy this file to config.php and update values as needed.
 * All settings are required unless marked as optional.
 *
 * Example:
 *   cp app/config/config_sample.php app/config/config.php
 *
 * This file is NOT tracked by git. Store sensitive credentials here.
 **********************************************/

/**********************************************
 *         Application Environment            *
 **********************************************/
// Set your timezone (e.g., 'America/New_York', 'UTC')
date_default_timezone_set('UTC');

// Error reporting level (E_ALL recommended for development)
error_reporting(E_ALL);

// Character encoding
if (function_exists('mb_internal_encoding') === true) {
    mb_internal_encoding('UTF-8');
}

// Default Locale Change as needed or feel free to remove.
if (function_exists('setlocale') === true) {
    setlocale(LC_ALL, 'en_US.UTF-8');
}

/**********************************************
 *           FlightPHP Core Settings          *
 **********************************************/

// Get the $app var to use below
if (empty($app) === true) {
    $app = Flight::app();
}

// This autoloads your code in the app directory so you don't have to require_once everything
// You'll need to namespace your classes with "app\folder\" to include them properly
$app->path(dirname(__DIR__, 2)); // CORRECTION ICI

// Core config variables
$isLocal = in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']);

if ($isLocal) {
    // Local : /TAKALO/public
    $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
} else {
    // Serveur : /ETU003955
    $baseUrl = '/ETU003955/TAKALO/public';
}

$app->set('flight.base_url', $baseUrl);  // Base URL for your app. Change if app is in a subdirectory (e.g., '/myapp/')
$app->set('flight.case_sensitive', false);    // Set true for case sensitive routes. Default: false
$app->set('flight.log_errors', true);         // Log errors to file. Recommended: true in production
$app->set('flight.handle_errors', false);     // Let Tracy handle errors if false. Set true to use Flight's error handler
$app->set('flight.views.path', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views'); // Path to views/templates
$app->set('flight.views.extension', '.php');  // View file extension (e.g., '.php', '.latte')
$app->set('flight.content_length', false);    // Send content length header. Usually false unless required by proxy

// Generate a CSP nonce for each request and store in $app
$nonce = bin2hex(random_bytes(16));
$app->set('csp_nonce', $nonce);

/**********************************************
 *           User Configuration               *
 **********************************************/

if ($isLocal) {
    $database = [
        'driver'   => 'mysql',
        'host'     => 'localhost:3306',
        'dbname'   => 'takalo_takalo',
        'user'     => 'root',
        'password' => '',
        'charset'  => 'utf8mb4'
    ];
} else {
    $database = [
        'driver'   => 'mysql',
        'host'     => 'localhost:3306',
        'dbname'   => 'db_s2_ETU003955',
        'user'     => 'ETU003955',
        'password' => 'ZkRvFN0a',
        'charset'  => 'utf8mb4'
    ];
}

return [
    'database' =>  $database
];

// app/config/constants.php

// Déterminer BASE_URL automatiquement
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script = $_SERVER['SCRIPT_NAME'];
$base = dirname($script);

// Si nous sommes dans un sous-dossier (ex: /projet)
if ($base !== '/') {
    define('BASE_URL', $protocol . '://' . $host . $base);
} else {
    define('BASE_URL', $protocol . '://' . $host);
}

// Optionnel : définir d'autres constantes utiles
define('SITE_NAME', '');
define('APP_ROOT', dirname(dirname(__DIR__)));