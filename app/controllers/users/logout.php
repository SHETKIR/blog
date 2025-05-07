<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login');
    exit;
}

session_unset();
session_destroy();
session_start();

$_SESSION['success'] = 'You have been logged out successfully';
header('Location: login');
exit; 