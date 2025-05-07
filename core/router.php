<?php

// Load the Router class
require_once CORE . '/classes/Router.php';

// Create a new Router instance
$router = new Router();

// Include routes configuration
require_once CONFIG . '/routes.php';
require_once CORE.'/db.php';

// Get the URI and method
$uri = trim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Special handling for PATCH and DELETE requests via POST
if ($requestMethod === 'POST' && isset($_POST['_method'])) {
    if ($_POST['_method'] === 'PATCH') {
        $requestMethod = 'PATCH';
    } elseif ($_POST['_method'] === 'DELETE') {
        $requestMethod = 'DELETE';
    }
}

// Empty URI is the home page
if ($uri === '') {
    $uri = '';
}

// Debug output
// echo "Current URI: '$uri'<br>";
// echo "<pre>Available Routes: " . print_r($routes, true) . "</pre>";

// Load the controller
if (isset($router->routes[$requestMethod][$uri])) {
    $controller = $router->routes[$requestMethod][$uri];
    if (file_exists(CONTROLLERS . "/{$controller}")) {
        require_once CONTROLLERS . "/{$controller}";
    } else {
        abort(404);
    }
} else {
    abort(404);
}
