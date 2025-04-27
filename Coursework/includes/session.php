<?php
function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function checkLogin() {
    startSession();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.html.php");
        exit();
    }
    return true;
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}