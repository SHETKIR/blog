<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$title = "BLOG P21";
$header = "Recent Posts";

$per_page = 5;
$posts = [];
$total = 0;

try {
    $total = $db->query(query: "SELECT count(*) FROM posts")->getColumn();
    if ($total === false) {
        echo "<!-- Error: count query returned false -->";
        $total = 0;
    }
} catch (Exception $e) {
    echo "<!-- Error in count query: " . $e->getMessage() . " -->";
    $total = 0;
}

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

try {
    $columns = $db->query("SHOW COLUMNS FROM posts")->findAll();
    $has_post_id = false;
    $has_id = false;
    
    foreach ($columns as $column) {
        if ($column['Field'] == 'post_id') {
            $has_post_id = true;
        }
        if ($column['Field'] == 'id') {
            $has_id = true;
        }
    }
    
    if ($has_post_id) {
        $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $start_elem, $per_page";
    } elseif ($has_id) {
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $start_elem, $per_page";
    } else {
        $sql = "SELECT * FROM posts LIMIT $start_elem, $per_page";
    }
    
    $result = $db->query(query: $sql);
    
    if ($result === false) {
        echo "<!-- Error: query returned false -->";
        $posts = [];
    } else {
        $posts = $result->findAll();
        if ($posts === false) {
            echo "<!-- Error: findAll returned false -->";
            $posts = [];
        }
    }
} catch (Exception $e) {
    echo "<!-- Error in main query: " . $e->getMessage() . " -->";
    $posts = [];
}

require_once(POSTS_VIEWS.'/index.tmpl.php'); 