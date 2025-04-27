<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    // Get all modules with post counts
    $stmt = $pdo->query('
        SELECT m.*, COUNT(p.id) as post_count 
        FROM modules m 
        LEFT JOIN posts p ON m.id = p.module_id 
        GROUP BY m.id
    ');
    $modules = $stmt->fetchAll();

    $title = 'Modules';
    $output = include '../templates/viewmodule.html.php';
    include '../templates/layout.html.php';

} catch (PDOException $e) {
    $error = 'Error fetching modules: ' . $e->getMessage();
    include '../templates/layout.html.php';
}