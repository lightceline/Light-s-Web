<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

$moduleId = $_GET['id'] ?? null;

if (!$moduleId) {
    header('Location: viewmodule.php');
    exit();
}

try {
    // Get module details
    $moduleStmt = $pdo->prepare('SELECT moduleName FROM modules WHERE id = ?');
    $moduleStmt->execute([$moduleId]);
    $module = $moduleStmt->fetch();

    if (!$module) {
        header('Location: viewmodule.php');
        exit();
    }

    // Get posts for this module
    $stmt = $pdo->prepare('
        SELECT p.*, u.username, u.email, m.moduleName 
        FROM posts p 
        JOIN users u ON p.user_id = u.id 
        JOIN modules m ON p.module_id = m.id 
        WHERE p.module_id = ? 
        ORDER BY p.created_at DESC
    ');
    $stmt->execute([$moduleId]);
    $posts = $stmt->fetchAll();

    $title = $module['moduleName'] . ' Posts';
    $output = include '../templates/modulepost.html.php';
    include '../templates/layout.html.php';

} catch (PDOException $e) {
    $error = 'Error fetching posts: ' . $e->getMessage();
    include '../templates/layout.html.php';
}