<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';
    
    $posts = allPosts($pdo);
    $title = 'Light';
    $totalPosts = totalPosts($pdo);
    $totalComments = totalComments($pdo);

    ob_start();
    include '../templates/post.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}    
include '../templates/layout_admin.html.php';
?>