<?php

$id = (int)$_GET['id'] ?? 0;
$sql = "SELECT * FROM `posts` WHERE `id` = ?";
$result = $db->query(query: $sql, params: [$id]);

if ($result === false) {
    abort(code: 404);
}

$post = $result->findOrAbort();

// Map id to post_id for consistency in templates
if (isset($post['id'])) {
    $post['post_id'] = $post['id'];
}

$title = "POST TITLE";
$header = $post['title'];


require_once VIEWS.'/post.tmpl.php'; 