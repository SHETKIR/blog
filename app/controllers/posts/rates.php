<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

global $db;

$data = json_decode(json: file_get_contents(filename: "php://input"), associative: true);//NULL | array
if($data) {
    $id = (int)$data['post_id'] ?? 0;
    $action = (int)$data['action'] ?? 0;
    
    $columns_query = "SHOW COLUMNS FROM posts";
    $columns_result = $db->query(query: $columns_query);
    if ($columns_result !== false) {
        $columns = $columns_result->findAll();
        echo "<!-- Table columns: ";
        print_r($columns);
        echo " -->";
    } else {
        echo "<!-- Error fetching columns -->";
    }
    
    $query = "SELECT rate FROM posts WHERE post_id = ? LIMIT 1";
    $result = $db->query(query: $query, params: [$id]);
    
    if ($result === false) {
        echo "<!-- Query failed: $query -->";
        $query = "SELECT rate FROM posts WHERE id = ? LIMIT 1";
        $result = $db->query(query: $query, params: [$id]);
        if ($result === false) {
            echo "<!-- Second query failed too: $query -->";
        }
    }
    
    if ($result === false) {
        echo "<!-- Both queries failed, setting rate to 0 -->";
        $rate = 0;
    } else {
        $rate = $result->getColumn();
        if ($rate === false || $rate === null) {
            echo "<!-- getColumn returned false or null -->";
            $rate = 0;
        } else {
            echo "<!-- Current rate: $rate -->";
        }
    }
    
    $rate = (int)$rate;
    $rate += $action;
    echo "<!-- New rate after adding action: $rate -->";
    
    $updateQuery = "UPDATE `posts` SET `rate` = ? WHERE `post_id` = ?";
    $updateResult = $db->query(query: $updateQuery, params: [$rate, $id]);
    
    if ($updateResult === false) {
        echo "<!-- Update query failed: $updateQuery -->";
    } else {
        $rowCount = $db->rowCount();
        echo "<!-- Rows affected: $rowCount -->";
    }
    
    if ($updateResult === false || $db->rowCount() === 0) {
        $updateQuery = "UPDATE `posts` SET `rate` = ? WHERE `id` = ?";
        $updateResult = $db->query(query: $updateQuery, params: [$rate, $id]);
        
        if ($updateResult === false) {
            echo "<!-- Second update query failed: $updateQuery -->";
        } else {
            $rowCount = $db->rowCount();
            echo "<!-- Rows affected by second query: $rowCount -->";
        }
    }
    
    if ($updateResult !== false && $db->rowCount() > 0) {
        echo $rate;
    } else {
        echo "Error updating rate";
    }
} else {
    echo "No data received";
} 