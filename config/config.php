<?php
/**
 * Application Configuration
 */

// Include constants
require_once __DIR__ . '/constants.php';

// Error Reporting
if (APP_ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Set default timezone
date_default_timezone_set('Asia/Jakarta');

// Session configuration
ini_set('session.gc_maxlifetime', SESSION_TIMEOUT);
session_start();

// CORS Headers (if needed for API)
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

// CSRF Token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Set language
define('LANGUAGE', 'id_ID');

// Load necessary files
require_once CONFIG_PATH . '/database.php';

// Autoload classes
spl_autoload_register(function ($class) {
    // PSR-4 autoloading
    $prefix = 'App\\';
    $base_dir = APP_PATH . '/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
