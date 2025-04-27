<?php
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';
try{
    if (isset($_POST['postContent'])){
        updatePosts($pdo, $_POST['postId'], $_POST['postContent'], $_POST['image']);
        header('location: post.php');
    }else{
        $post = getPosts($pdo, $_GET['id']);
        $title = 'Edit post';

        ob_start();
        include '../templates/editpost.html.php';
        $output = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output = 'Error editing post: ' . $e->getMessage();
}
include '../templates/layout.html.php';    