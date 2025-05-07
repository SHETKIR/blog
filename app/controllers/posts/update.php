<?php
global $db;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /posts');
    exit;
}

$id = (int)$_POST['id'] ?? 0;

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$excerpt = trim($_POST['excerpt'] ?? '');

$errors = [];

if (empty($title)) {
    $errors['title'] = 'Title is required';
}

if (empty($content)) {
    $errors['content'] = 'Content is required';
}

if (empty($excerpt)) {
    $errors['excerpt'] = 'Excerpt is required';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'title' => $title,
        'content' => $content,
        'excerpt' => $excerpt
    ];
    header("Location: /posts/edit?id=$id");
    exit;
}

$sql = "UPDATE posts SET title = :title, content = :content, excerpt = :excerpt WHERE id = :id";
$result = $db->query($sql, [
    'title' => $title,
    'excerpt' => $excerpt,
    'content' => $content,
    'id' => $id
]);

if (!$result) {
    $_SESSION['error'] = 'An error occurred while updating the post';
    header("Location: /posts/edit?id=$id");
    exit;
}

$_SESSION['success'] = 'Post updated successfully';
header("Location: /post?id=$id");
exit; 