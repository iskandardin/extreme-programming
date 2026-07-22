<?php
if (!defined('APP_NAME')) {
    require_once __DIR__ . '/../../config/config.php';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container navbar-container">
            <div class="navbar-brand">
                <a href="<?php echo SITE_URL; ?>">🏥 <?php echo APP_NAME; ?></a>
            </div>
            <ul class="navbar-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?php echo SITE_URL; ?>?page=patient&action=dashboard">Dashboard</a></li>
                    <li><a href="<?php echo SITE_URL; ?>?page=patient&action=profile">Profil</a></li>
                    <li><a href="<?php echo SITE_URL; ?>?page=auth&action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo SITE_URL; ?>?page=auth&action=login">Login</a></li>
                    <li><a href="<?php echo SITE_URL; ?>?page=auth&action=register">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container" style="margin-top: var(--spacing-xl); margin-bottom: var(--spacing-xl);">
