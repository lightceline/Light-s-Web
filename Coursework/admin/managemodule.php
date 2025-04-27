<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    $modules = $pdo->query('
        SELECT m.*, COUNT(p.id) as post_count 
        FROM modules m 
        LEFT JOIN posts p ON m.id = p.module_id 
        GROUP BY m.id
    ')->fetchAll();
    
    $title = 'Manage Modules';
    ob_start();
    include '../templates/managemodule.html.php';
    $output = ob_get_clean();
    include '../templates/layout_admin.html.php';

} catch (PDOException $e) {
    $error = 'Error fetching modules: ' . $e->getMessage();
    include '../templates/layout_admin.html.php';
}