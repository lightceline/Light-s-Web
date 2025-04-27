<?php
require_once '../includes/session.php';
startSession();

require '../includes/DatabaseConnection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, email, password, role FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // echo print_r($user, true);
    // echo print_r(password_verify($password, $user['password']), true);
    // echo $user && password_verify($password, $user['password']);

    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        
        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../user/index.php");
        }
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.html.php");
        exit();

    }
}
