<?php

global $db;

$id = (int)$_POST['id'] ?? 0;

if ($id <= 0) {
    $_SESSION['error'] = "Invalid post ID";
    redirect(url: '/');
}

// Debug: Output the post ID
$_SESSION['debug'] = "Attempting to downvote post ID: " . $id;

// Use the exact column name (id) as shown in the database screenshot
$sql = "UPDATE `posts` SET `rate` = `rate` - 1 WHERE `id` = ?";
$update = $db->query($sql, [$id]);

if ($update !== false && $db->rowCount() > 0) {
    $_SESSION['success'] = "Post downvoted successfully";
} else {
    // Check if the post exists
    $check_sql = "SELECT * FROM `posts` WHERE `id` = ?";
    $check_result = $db->query($check_sql, [$id]);
    
    if ($check_result !== false && $check_result->find()) {
        $_SESSION['error'] = "Post exists but update failed - possibly no change in rating";
    } else {
        $_SESSION['error'] = "Failed to downvote post - post not found with ID: " . $id;
    }
}

// Redirect back to the post page
redirect(url: '/post?id=' . $id); 