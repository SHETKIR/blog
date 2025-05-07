<?php

class Router {
    public $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'DELETE' => []
    ];
    
    protected $uri;
    
    protected $method;
    
    public function __construct() {
        $this->uri = trim(string: parse_url(url: $_SERVER['REQUEST_URI'])['path'], characters: '/');
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    
    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
        return $this;
    }
    
    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
        return $this;
    }
    
    public function patch($uri, $controller) {
        $this->routes['PATCH'][$uri] = $controller;
        return $this;
    }
    
    public function delete($uri, $controller) {
        $this->routes['DELETE'][$uri] = $controller;
        return $this;
    }
    
    public function direct($uri, $requestMethod) {
        if (array_key_exists($uri, $this->routes[$requestMethod])) {
            return $this->routes[$requestMethod][$uri];
        }
        
        abort(404);
    }
    
    public function match(): void 
    {
        $isMatched = false;
        // dump($this->routes);
        foreach($this->routes[$this->method] as $route => $controller) {
            if(($route == $this->uri)) {
                $isMatched = true;
                
                require_once(CONTROLLERS.'/'.($controller).'.php');
                break;
            }
        }
        
        if(!$isMatched) {
            abort();
        }
    }
} 