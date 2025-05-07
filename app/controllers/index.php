<?php
$title = "BLOG";
$header = "Recent posts";

$per_page = 5; 
$total = $db->query(query: "SELECT count(*) FROM posts")->getColumn();

require_once CLASSES . '/Paginator.php';
$paginator = new Paginator(
    page: isset($_GET['page']) ? (int)$_GET['page'] : 1,
    per_page: $per_page,
    total: $total
);

if($paginator->page < 1) {
    $paginator->page = 1;
}
else if($paginator->page > $paginator->pages_count) {
    $paginator->page = $paginator->pages_count;
}

$start_elem = ($paginator->page - 1) * $paginator->per_page;

$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $start_elem, $per_page";
$posts = $db->query($sql)->findAll();

foreach ($posts as &$post) {
    if (isset($post['id'])) {
        $post['post_id'] = $post['id'];
    }
}
unset($post);

$most_popular_posts = $db->query(query: "SELECT * FROM posts ORDER BY id DESC LIMIT 5")->findAll();

require_once(VIEWS . '/index.tmpl.php'); 