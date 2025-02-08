<?php

namespace Core;

class Router
{
    protected array $routes = [];
    public function add(string $uri, string $method, string $controller): void {}
    public function dispatch(string $uri, string $method): string
    {
        return '';
    }

    protected function findRoute(string $uri, string $method): ?array
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                $params = $this->matchRoute($route['uri'], $uri);
                if ($$params !== null) {
                    return [...$route, 'params' => $params];
                }
            }
        }
    }

    protected function matchRoute(string $routeUri, string $reqUri): ?array
    {
        $routeSegments = explode('/', trim($routeUri, '/'));
        $reqSegments = explode('/', trim($reqUri, '/'));

        if (count($routeSegments) !== count($reqSegments)) {
            return null;
        }
        $params = [];
        foreach ($routeSegments as $index => $segment) {
            if (str_starts_with($segment, '{') && str_ends_with($segment, '}')) {
                $params[trim($segment, '{}')] = $reqSegments[$index];
            } elseif ($segment !== $reqSegments[$index]) {
                return null;
            }
        }
        return $params;
    }

    protected function callAction(string $controller, string $action, array $params): string
    {
        $controllerClass = "App\\Controllers\\$controller";
        return (new $controllerClass)->$action($params);
    }
}
