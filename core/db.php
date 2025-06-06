<?php

$db_config = include CONFIG . '/db.php';
require_once CORE . '/classes/DB.php';

if (is_array($db_config)) {
    $db = DB::getInstance();
    $db->getConnection($db_config);
} else {
    die('Database configuration error: config is not an array');
} 