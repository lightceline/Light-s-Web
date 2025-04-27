<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    $users = $pdo->query('SELECT * FROM users')->fetchAll();
    
    $title = 'Manage Users';
    ob_start();
    include '../templates/manageuser.html.php';
    $output = ob_get_clean();

    if (empty($output)) {
        throw new Exception('Template output is empty');
    }
    
    include '../templates/layout_admin.html.php';

} catch (PDOException $e) {
    $output = 'Error fetching users: ' . $e->getMessage();
    include '../templates/layout_admin.html.php';
} catch (Exception $e) {
    $output = $e->getMessage();
    include '../templates/layout_admin.html.php';
}