<?php
require_once '../includes/session.php';
checkLogin();

if (isset($_POST['submit'])) {

    var_dump($_FILES);


    try {
        include '../includes/DatabaseConnection.php';
        include '../includes/DatabaseFunction.php';

        $imagePath = 'null'; // Default to null if no image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = '../uploads/';
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    throw new Exception("Failed to create uploads directory.");
                }
            }

            $targetFile = $targetDir . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Validate image file
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }

            // Allow only certain file formats
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Move the uploaded file to the uploads directory
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                throw new Exception("There was an error uploading your file.");
            }

            // Save the image filename
            
        }
        
        $imagePath = basename($_FILES['image']['name']);
        // echo json_encode([ 'data' => $imagePath ]);
        // Add post to the database
        insertPosts($pdo, $_POST['postContent'], $_POST['user_id'], $_POST['module_id'], $imagePath);

        // Redirect to the posts list
        header('location: post.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunction.php';

    $users = allUsers($pdo);
    $modules = allModules($pdo);
    ob_start();
    include '../templates/addpost.html.php';
    $output = ob_get_clean();
}
include '../templates/layout.html.php';