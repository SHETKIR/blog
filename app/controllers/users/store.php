<?php
global $db;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

$_SESSION['old'] = [
    'name' => $name,
    'email' => $email
];

$errors = [];

if (empty($name)) {
    $errors['name'] = 'Name is required';
} elseif (strlen($name) < 3) {
    $errors['name'] = 'Name must be at least 3 characters';
}

if (empty($email)) {
    $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email is invalid';
} else {
    $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
    $exists = $db->query($sql, ['email' => $email])->find();
    
    if ($exists) {
        $errors['email'] = 'Email already exists';
    }
}

if (empty($password)) {
    $errors['password'] = 'Password is required';
} elseif (strlen($password) < 8) {
    $errors['password'] = 'Password must be at least 8 characters';
}

if (empty($password_confirm)) {
    $errors['password_confirm'] = 'Password confirmation is required';
} elseif ($password !== $password_confirm) {
    $errors['password_confirm'] = 'Passwords do not match';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: register');
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$result = $db->query($sql, [
    'name' => $name,
    'email' => $email,
    'password' => $hashed_password
]);

if (!$result) {
    $_SESSION['error'] = 'An error occurred during registration';
    header('Location: register');
    exit;
}

unset($_SESSION['errors']);
unset($_SESSION['old']);

$_SESSION['success'] = 'Registration successful! You can now log in.';
header('Location: login');
exit; 