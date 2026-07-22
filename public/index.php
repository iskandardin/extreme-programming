<?php
/**
 * Main Entry Point
 */

// Load configuration
require_once __DIR__ . '/../config/config.php';

// Get current page
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'index';

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$user_role = $_SESSION['role'] ?? null;

// Simple routing
$valid_pages = ['auth', 'patient', 'doctor', 'admin', 'health', 'appointment'];

if (!$is_logged_in && $page !== 'auth') {
    header('Location: ' . SITE_URL . '/?page=auth&action=login');
    exit;
}

// Route to page
if (in_array($page, $valid_pages) && file_exists(VIEWS_PATH . '/' . $page . '/' . $action . '.php')) {
    include VIEWS_PATH . '/' . $page . '/' . $action . '.php';
} else {
    // Default to home/login
    if ($is_logged_in) {
        if ($user_role === ROLE_PATIENT) {
            include VIEWS_PATH . '/patient/dashboard.php';
        } elseif ($user_role === ROLE_DOCTOR) {
            include VIEWS_PATH . '/doctor/dashboard.php';
        } elseif ($user_role === ROLE_ADMIN) {
            include VIEWS_PATH . '/admin/dashboard.php';
        }
    } else {
        include VIEWS_PATH . '/auth/login.php';
    }
}
