<?php
    if (isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

require_once('app/views/users/login.tmpl.php'); 