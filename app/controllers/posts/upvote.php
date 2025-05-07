<?php

global $db;

$debug_info = [];
$debug_info[] = "Starting upvote process";

$id = (int)$_POST['id'] ?? 0;
$debug_info[] = "Post ID: " . $id;

if ($id <= 0) {
    $_SESSION['error'] = "Invalid post ID";
    redirect(url: '/');
}

$sql = "SELECT * FROM `posts` WHERE `id` = ?";
$result = $db->query($sql, [$id]);
$post = $result !== false ? $result->find() : false;

if (!$post) {
    $debug_info[] = "Post not found with ID: " . $id;
    $_SESSION['error'] = "Post not found";
    $_SESSION['debug'] = implode("<br>", $debug_info);
    redirect(url: '/');
}

$debug_info[] = "Post exists. Current data: " . json_encode($post);


$sql = "UPDATE `posts` SET `rate` = `rate` + 1 WHERE `id` = ?";
$update = $db->query($sql, [$id]);

$debug_info[] = "Update SQL: " . $sql . " with ID = " . $id;
$debug_info[] = "Update result: " . ($update !== false ? "Query executed" : "Query failed");

if ($update !== false) {
    $rowCount = $db->rowCount();
    $debug_info[] = "Rows affected: " . $rowCount;
    
    if ($rowCount > 0) {
        $verify_sql = "SELECT `rate` FROM `posts` WHERE `id` = ?";
        $verify_result = $db->query($verify_sql, [$id]);
        $updated_post = $verify_result !== false ? $verify_result->find() : false;
        
        if ($updated_post) {
            $debug_info[] = "New rate value: " . $updated_post['rate'];
            $_SESSION['success'] = "Post upvoted successfully. New rating: " . $updated_post['rate'];
        } else {
            $debug_info[] = "Could not verify new rate value";
            $_SESSION['success'] = "Post upvoted successfully but could not verify new rating";
        }
    } else {
        $debug_info[] = "No rows were affected by the update";
        $_SESSION['error'] = "No changes made to rating";
    }
} else {
    $debug_info[] = "Update query failed";
    $_SESSION['error'] = "Failed to upvote post - database error";
}

$_SESSION['debug'] = implode("<br>", $debug_info);

redirect(url: '/post?id=' . $id); 