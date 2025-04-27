<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    // Fetch statistics
    $totalUsers = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $totalPosts = $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    $totalModules = $pdo->query('SELECT COUNT(*) FROM modules')->fetchColumn();
    
    $title = 'Control Panel';
    ob_start();
    include '../templates/controlpanel.html.php';
    $output = ob_get_clean();
    include '../templates/layout_admin.html.php';

} catch (PDOException $e) {
    $error = 'Database error: ' . $e->getMessage();
    include '../templates/layout_admin.html.php';
}