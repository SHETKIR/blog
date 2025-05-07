<?php
// Database setup script

require_once 'config/config.php';
require_once CORE . '/db.php';

// Check if the posts table exists
$sql = "SHOW TABLES LIKE 'posts'";
$result = $db->query($sql);
$tableExists = $result !== false && $result->find();

if (!$tableExists) {
    // Create the posts table
    $sql = "CREATE TABLE `posts` (
        `post_id` INT(11) NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `slug` VARCHAR(255) NOT NULL,
        `excerpt` TEXT NOT NULL,
        `content` TEXT NOT NULL,
        `rate` INT NOT NULL DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`post_id`),
        UNIQUE KEY `slug` (`slug`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if ($db->query($sql)) {
        echo "The 'posts' table was created successfully!";
    } else {
        echo "Error creating the 'posts' table.";
    }
} else {
    // Check if rate column exists
    $sql = "SHOW COLUMNS FROM `posts` LIKE 'rate'";
    $result = $db->query($sql);
    $rateColumnExists = $result !== false && $result->find();
    
    if (!$rateColumnExists) {
        // Add rate column if it doesn't exist
        $sql = "ALTER TABLE `posts` ADD COLUMN `rate` INT NOT NULL DEFAULT 0";
        if ($db->query($sql)) {
            echo "The 'rate' column was added to the 'posts' table.";
        } else {
            echo "Error adding 'rate' column to the 'posts' table.";
        }
    } else {
        echo "The 'posts' table already exists with a 'rate' column.";
    }
}
?> 