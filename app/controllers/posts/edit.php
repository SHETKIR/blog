<?php
global $db;

$id = (int)$_GET['id'] ?? 0;

$sql = "SELECT * FROM `posts` WHERE `id` = ?";
$result = $db->query(query: $sql, params: [$id]);

if ($result === false) {
    abort(code: 404);
}

$post = $result->findOrAbort();

if (isset($post['id'])) {
    $post['post_id'] = $post['id'];
}

$title = "Edit Post";
$header = "Edit Post: {$post['title']}";

require_once VIEWS.'/posts/edit.tmpl.php'; 