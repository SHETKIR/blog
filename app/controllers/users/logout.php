<?php
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header('Location: login');
    exit;
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Start a new session
session_start();

// Set success message and redirect to login page
$_SESSION['success'] = 'You have been logged out successfully';
header('Location: login');
exit; 