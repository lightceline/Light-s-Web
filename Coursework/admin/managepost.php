<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    $posts = $pdo->query('
        SELECT p.*, u.username, m.moduleName 
        FROM posts p 
        JOIN users u ON p.user_id = u.id 
        JOIN modules m ON p.module_id = m.id 
        ORDER BY p.created_at DESC
    ')->fetchAll();
    
    $title = 'Manage Posts';
    ob_start();
    include '../templates/managepost.html.php';
    $output = ob_get_clean();
    include '../templates/layout_admin.html.php';

} catch (PDOException $e) {
    $error = 'Error fetching posts: ' . $e->getMessage();
    include '../templates/layout_admin.html.php';
}