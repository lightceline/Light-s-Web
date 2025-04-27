<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    if (isset($_POST['id']) && isset($_POST['moduleName'])) {
        $stmt = $pdo->prepare('UPDATE modules SET moduleName = ? WHERE id = ?');
        $stmt->execute([$_POST['moduleName'], $_POST['id']]);
        header('Location: managemodule.php');
        exit();
    }
} catch (PDOException $e) {
    $error = 'Error updating module: ' . $e->getMessage();
    include '../templates/layout_admin.html.php';
}

include '../templates/layout_admin.html.php';