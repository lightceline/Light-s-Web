<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    if (isset($_POST['username'])) {
        $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?');
        $stmt->execute([
            $_POST['username'],
            $_POST['email'],
            $_POST['role'],
            $_POST['id']
        ]);
        
        header('Location: manageuser.php');
        exit();
    }
} catch (PDOException $e) {
    $error = 'Error updating user: ' . $e->getMessage();
    include '../templates/error.html.php';
}