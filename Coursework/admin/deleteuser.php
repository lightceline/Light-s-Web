<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

checkLogin();

try {
    if (isset($_POST['id'])) {
        // Check if user exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$_POST['id']]);
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception('User not found');
        }

        // Don't allow deleting the last admin
        $adminCount = $pdo->query('SELECT COUNT(*) FROM users WHERE role = "admin"')->fetchColumn();
        if ($user['role'] === 'admin' && $adminCount <= 1) {
            throw new Exception('Cannot delete the last admin user');
        }

        // Delete user's posts
        $stmt = $pdo->prepare('DELETE FROM posts WHERE user_id = ?');
        $stmt->execute([$_POST['id']]);

        // Delete user's comments
        $stmt = $pdo->prepare('DELETE FROM comments WHERE user_id = ?');
        $stmt->execute([$_POST['id']]);

        // Delete the user
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$_POST['id']]);

        header('Location: manageuser.php');
        exit();
    }
} catch (Exception $e) {
    $error = 'Error deleting user: ' . $e->getMessage();
    include '../templates/error.html.php';
}