<?php
class Router
{
    protected $routes = []; // stores routes

    public function addRoute(string $method, string $url, closure $target)
    {
        $this->routes[$method][$url] = $target;
    }

    public function matchRoute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {
                
                // Simple check if parameter lang is empthy then we display 404 error
                if (empty($_GET['lang'])) {
                    http_response_code(404);
                    throw new Exception('Route not found');
                }
                
                // Simple string comparison to see if the route URL matches the requested URL
                if ($routeUrl === $url) {
                    call_user_func($target);
                }
            }
        }

        throw new Exception('Route not found');
    }
}
