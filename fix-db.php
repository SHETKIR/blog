<?php
// Database fix script

require_once 'config/config.php';
require_once CORE . '/db.php';

// Check if the rate column exists in posts table
$sql = "SHOW COLUMNS FROM `posts` LIKE 'rate'";
$result = $db->query($sql);
$column_exists = $result !== false && $result->find();

if (!$column_exists) {
    // Add rate column to posts table
    $sql = "ALTER TABLE `posts` ADD COLUMN `rate` INT NOT NULL DEFAULT 0";
    
    if ($db->query($sql) !== false) {
        echo "<h2>Success!</h2>";
        echo "<p>The 'rate' column was added successfully to the 'posts' table.</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>Failed to add 'rate' column to the 'posts' table.</p>";
    }
} else {
    // Force alter the rate column to ensure correct definition
    $sql = "ALTER TABLE `posts` MODIFY COLUMN `rate` INT NOT NULL DEFAULT 0";
    
    if ($db->query($sql) !== false) {
        echo "<h2>Success!</h2>";
        echo "<p>The 'rate' column was updated successfully in the 'posts' table.</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>Failed to update 'rate' column in the 'posts' table.</p>";
    }
}

// Final check
$sql = "SHOW COLUMNS FROM `posts` LIKE 'rate'";
$result = $db->query($sql);
$rate_column = $result !== false ? $result->find() : false;

echo "<h2>Rate Column Status</h2>";
if ($rate_column) {
    echo "<pre>" . print_r($rate_column, true) . "</pre>";
    echo "<p style='color:green'>Rate column exists in the database.</p>";
} else {
    echo "<p style='color:red'>Rate column does not exist in the database.</p>";
}

// Try updating a value
$sql = "SELECT `id` FROM `posts` LIMIT 1";
$result = $db->query($sql);
$first_post = $result !== false ? $result->find() : false;

if ($first_post) {
    $id = $first_post['id'];
    
    // Set rate to 99 to clearly see if it works
    $sql = "UPDATE `posts` SET `rate` = 99 WHERE `id` = ?";
    $updated = $db->query($sql, [$id]);
    
    if ($updated !== false) {
        echo "<p style='color:green'>Successfully updated rate for post ID {$id} to 99.</p>";
        
        // Verify the update
        $sql = "SELECT `rate` FROM `posts` WHERE `id` = ?";
        $result = $db->query($sql, [$id]);
        $post_rate = $result !== false && ($post = $result->find()) ? $post['rate'] : null;
        
        if ($post_rate === 99) {
            echo "<p style='color:green'>Verified update: rate is now 99 for post ID {$id}.</p>";
        } else {
            echo "<p style='color:red'>Failed to verify update. Current rate: " . $post_rate . "</p>";
        }
    } else {
        echo "<p style='color:red'>Failed to update rate for post ID {$id}.</p>";
    }
} else {
    echo "<p>No posts found to test update.</p>";
}
?> 