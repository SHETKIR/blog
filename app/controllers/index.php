<?php
$title = "BLOG";
$header = "Recent posts";

// Pagination settings
$per_page = 5; // 5 posts per page
$total = $db->query(query: "SELECT count(*) FROM posts")->getColumn(); // Total posts count

// Create paginator instance
require_once CLASSES . '/Paginator.php';
$paginator = new Paginator(
    page: isset($_GET['page']) ? (int)$_GET['page'] : 1,
    per_page: $per_page,
    total: $total
);

// Ensure page is within valid range
if($paginator->page < 1) {
    $paginator->page = 1;
}
else if($paginator->page > $paginator->pages_count) {
    $paginator->page = $paginator->pages_count;
}

$start_elem = ($paginator->page - 1) * $paginator->per_page;

// Fetch posts with pagination
$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $start_elem, $per_page";
$posts = $db->query($sql)->findAll();

// Map the database ID to post_id for use in templates
foreach ($posts as &$post) {
    if (isset($post['id'])) {
        $post['post_id'] = $post['id'];
    }
}
unset($post); // Break the reference

// Most popular posts for sidebar
$most_popular_posts = $db->query(query: "SELECT * FROM posts ORDER BY id DESC LIMIT 5")->findAll();

require_once(VIEWS . '/index.tmpl.php'); 