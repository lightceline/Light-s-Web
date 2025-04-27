<?php 
session_start();
require '../includes/DatabaseConnection.php';
require '../includes/DatabaseFunction.php';

$error = '';

if (isset($_POST['Register'])){
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';
    
    // Input validation
    if (empty($email) || empty($username) || empty($password)) {
        $error = "Please enter your information";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format";
    } elseif (strlen($password) < 6) {  // Changed minimum password length
        $error = "Password must be at least 6 characters";
    } elseif ($password !== $confirm_password) {
        $error = "Password and Confirm Password do not match!";
    } else {
        try {
            // Check username exist
            $checkUsername = $pdo->prepare("SELECT id FROM users WHERE username = :username");
            $checkUsername->bindParam(':username', $username, PDO::PARAM_STR);
            $checkUsername->execute();

            // Check email exist
            $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $checkEmail->bindParam(':email', $email, PDO::PARAM_STR);   
            $checkEmail->execute();

            if ($checkUsername->rowCount() > 0) {
                $error = "Username Already Exists!";
            } elseif ($checkEmail->rowCount() > 0) {
                $error = "Email Address Already Exists!";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_ARGON2I);
                insertUser($pdo, $username, $email, $hashedPassword, $role);
                
                // Set session variables after successful registration
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                
                header("Location: ../user/index.php");
                exit();
            }
        } catch(PDOException $e) {
            $error = "Registration failed. Please try again.";
            error_log($e->getMessage());
        }
    }
}

include 'register.html.php';
?>