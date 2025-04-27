<?php
session_start();
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate input
        if (empty($_POST['commentContent'])) {
            throw new Exception('Comment cannot be empty');
        }
        
        if (!isset($_POST['post_id']) || empty($_POST['post_id'])) {
            throw new Exception('Post ID is required');
        }

        // Get the current user's ID from session
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('You must be logged in to comment');
        }

        $userId = $_SESSION['user_id'];
        $postId = $_POST['post_id'];
        $commentContent = $_POST['commentContent'];

        insertComments($pdo, $postId, $userId, $commentContent);

        // Redirect back to the post page
        header('Location: fullpost.php?id=' . $postId);
        exit;
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to add comment: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include '../templates/layout.html.php';