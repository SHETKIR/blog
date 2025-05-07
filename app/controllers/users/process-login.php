<?php
global $db;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'All fields are required';
    header('Location: login');
    exit;
}

$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
$user = $db->query($sql, ['email' => $email])->find();

if (!$user) {
    $_SESSION['error'] = 'Invalid credentials';
    header('Location: login');
    exit;
}

if (!password_verify($password, $user['password'])) {
    $_SESSION['error'] = 'Invalid credentials';
    header('Location: login');
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];

$_SESSION['success'] = 'You have been logged in successfully';
header('Location: /');
exit; 