<?php
// Lấy dữ liệu
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunction.php';

$posts = allPosts($pdo);
$totalPosts = totalPosts($pdo);

session_start();
ob_start();
include '../templates/home.html.php';
$output = ob_get_clean();
require_once '../templates/layout_admin.html.php';