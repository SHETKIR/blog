<?php

require_once CORE . '/classes/Router.php';

$router = new Router();

require_once CONFIG . '/routes.php';
require_once CORE.'/db.php';

$uri = trim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST' && isset($_POST['_method'])) {
    if ($_POST['_method'] === 'PATCH') {
        $requestMethod = 'PATCH';
    } elseif ($_POST['_method'] === 'DELETE') {
        $requestMethod = 'DELETE';
    }
}

if ($uri === '') {
    $uri = '';
}

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
