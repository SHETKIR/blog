<?php

global $db;

$data = file_get_contents(filename: "php://input");
$api_data = json_decode(json: $data, associative: true);
$data = $api_data ?? $_POST;
$id = (int)$data['id'] ?? 0;

$sql = "DELETE FROM `posts` WHERE `id` = ?";
$post = $db->query(query: $sql, params: [$id]);

if($db->rowCount()) {
    $resp['answer'] = $_SESSION['success'] = "Post deleted successfully";
} 
else {
    $resp['answer'] = $_SESSION['error'] = "Delete Error";
}

if($api_data) {
    echo json_encode(value: $resp);
    die;
}

redirect(url: '/');