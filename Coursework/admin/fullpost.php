<?php
session_start(); // Add this at the very top

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.html.php");
    exit();
}

try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Invalid post ID.");
    }

    $postId = (int) $_GET['id'];
    $post = getPostWithComments($pdo, $postId);

    if (!$post) {
        error_log("Post not found for ID: " . $postId);
        throw new Exception("Post not found.");
    }

    $comments = $post['comments'];
    $totalComments = count($comments);

    ob_start();
    include '../templates/fullpost.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error occurred';
    $output = '<p>Error: ' . $e->getMessage() . '</p>';
}

include '../templates/layout_admin.html.php';