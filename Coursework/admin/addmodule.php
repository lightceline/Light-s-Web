<?php
require_once '../includes/session.php';
checkLogin();
    try {
        include '../includes/DatabaseConnection.php';
        include '../includes/DatabaseFunction.php';

        
        insertModules($pdo, $_POST['moduleName']);

        // Redirect to the posts list
        header('location: managemodule.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();


        $users = allUsers($pdo);
        $modules = allModules($pdo);
        ob_start();
        include '../templates/controlpanel.html.php';
        $output = ob_get_clean();
    }
// include '../templates/layout_admin.html.php';