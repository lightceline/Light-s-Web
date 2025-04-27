<?php
// $target_dir = '../uploads/';
// if (isset($_FILES["post_image"])) {
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// $target_file = $target_dir . basename($_FILES["image"]["name"]);
// }


//uploadFile.php
session_start();

// Directory where images will be stored
$target_dir = "../uploads/";

// Ensure the directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if file is uploaded
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $file_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['upload_error'] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        $_SESSION['upload_error'] = "File is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "png", "jpeg", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['upload_error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if upload is allowed
    if ($uploadOk == 0) {
        $_SESSION['upload_error'] = "File was not uploaded.";
    } else {
        // Attempt to move the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $_SESSION['upload_success'] = "The file " . htmlspecialchars($file_name) . " has been uploaded.";
        } else {
            $_SESSION['upload_error'] = "There was an error uploading your file.";
        }
    }
} else {
    $_SESSION['upload_error'] = "No file uploaded.";
}


header("Location: ../admin/addpost.php");
exit();

// $target_dir = '../uploads/';
// if (isset($_FILES["fileToUpload"])) {
// 	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// 	$uploadOk = 1;
// 	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// } else {
// 	$uploadOk = 0;
// 	echo "Error: No file uploaded or incorrect form field name.";
// }