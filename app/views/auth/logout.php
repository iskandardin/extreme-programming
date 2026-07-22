<?php
// Destroy session
session_destroy();

// Redirect to login
header('Location: ' . SITE_URL . '?page=auth&action=login');
exit;
