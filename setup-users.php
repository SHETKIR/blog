<?php
require_once __DIR__ . '/core/bootstrap.php';
require_once CORE . '/db.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($db->query($sql)) {
    echo "<p style='color:green'>Users table created successfully</p>";
} else {
    echo "<p style='color:red'>Error creating users table</p>";
} 