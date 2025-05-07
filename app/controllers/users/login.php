<?php
// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to home page
    header('Location: /');
    exit;
}

// Load the login view
require_once('app/views/users/login.tmpl.php'); 