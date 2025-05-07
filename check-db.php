<?php

require_once 'config/config.php';
require_once CORE . '/db.php';

$sql = "SHOW COLUMNS FROM `posts` LIKE 'rate'";
$result = $db->query($sql);
$column_exists = $result !== false && $result->find();

if (!$column_exists) {
    $sql = "ALTER TABLE `posts` ADD COLUMN `rate` INT DEFAULT 0";
    
    if ($db->query($sql) !== false) {
        echo "<h2>Success!</h2>";
        echo "<p>The 'rate' column was added successfully to the 'posts' table.</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>Failed to add 'rate' column to the 'posts' table.</p>";
    }
} else {
    $sql = "SHOW CREATE TABLE `posts`";
    $result = $db->query($sql);
    $table_def = $result !== false ? $result->find() : false;
    
    echo "<h2>Database Structure</h2>";
    
    if ($table_def) {
        echo "<pre>" . print_r($table_def, true) . "</pre>";
    }
    
    $sql = "SELECT `id`, `title`, `rate` FROM `posts` LIMIT 10";
    $result = $db->query($sql);
    $posts = $result !== false ? $result->findAll() : [];
    
    echo "<h2>Current Posts</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Title</th><th>Rate (Current)</th></tr>";
    
    foreach ($posts as $post) {
        echo "<tr>";
        echo "<td>" . $post['id'] . "</td>";
        echo "<td>" . $post['title'] . "</td>";
        echo "<td>" . (isset($post['rate']) ? $post['rate'] : 'NULL') . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    if (!empty($posts)) {
        $first_post_id = $posts[0]['id'];
        $current_rate = isset($posts[0]['rate']) ? (int)$posts[0]['rate'] : 0;
        $new_rate = $current_rate + 1;
        
        $sql = "UPDATE `posts` SET `rate` = {$new_rate} WHERE `id` = {$first_post_id}";
        
        if ($db->query($sql) !== false) {
            $sql = "SELECT `rate` FROM `posts` WHERE `id` = {$first_post_id}";
            $result = $db->query($sql);
            $updated_post = $result !== false ? $result->find() : false;
            
            echo "<h2>Update Test</h2>";
            
            if ($updated_post && isset($updated_post['rate']) && $updated_post['rate'] == $new_rate) {
                echo "<p style='color:green'>Successfully updated rate for post ID {$first_post_id} from {$current_rate} to {$new_rate}.</p>";
            } else {
                echo "<p style='color:red'>Failed to verify rate update. Current value: " . 
                     ($updated_post && isset($updated_post['rate']) ? $updated_post['rate'] : 'unknown') . "</p>";
            }
        } else {
            echo "<h2>Update Test</h2>";
            echo "<p style='color:red'>Failed to update rate for post ID {$first_post_id}.</p>";
        }
    }
}
?> 