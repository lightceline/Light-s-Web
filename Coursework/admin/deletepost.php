<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';

    
    // If post has an image, delete it from uploads folder
    if (!empty($post['image'])) {
        $imagePath = '../uploads/' . $post['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the post from database
    deletePosts($pdo, $_POST['id']);
    header('location: post.php');
    exit;
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete post: ' . $e->getMessage();
}
include '../templates/layout_admin.html.php';