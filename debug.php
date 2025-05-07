<?php

require_once 'config/config.php';
require_once CORE . '/db.php';
require_once CORE . '/classes/Router.php';

echo "<h1>Debug Information</h1>";

echo "<h2>Router Routes</h2>";
$router = new Router();
require_once CONFIG . '/routes.php';

echo "<pre>";
print_r($router->routes);
echo "</pre>";

echo "<h2>Database Tables</h2>";
try {
    $tables = $db->query("SHOW TABLES")->findAll();
    echo "<pre>";
    print_r($tables);
    echo "</pre>";
    
    echo "<h2>Posts Table Structure</h2>";
    $structure = $db->query("DESCRIBE posts")->findAll();
    echo "<pre>";
    print_r($structure);
    echo "</pre>";
    
    echo "<h2>Sample Posts Data</h2>";
    $posts = $db->query("SELECT * FROM posts LIMIT 3")->findAll();
    echo "<pre>";
    print_r($posts);
    echo "</pre>";
} catch (Exception $e) {
    echo "<p>Error accessing database: " . $e->getMessage() . "</p>";
}

echo "<h2>Request Information</h2>";
echo "<p>Current URI: " . parse_url($_SERVER['REQUEST_URI'])['path'] . "</p>";
echo "<p>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</p>";

echo "<h2>Router Class</h2>";
echo "<pre>";
print_r(get_class_methods('Router'));
echo "</pre>";
?> 