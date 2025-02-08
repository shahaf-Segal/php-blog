<?php

namespace Core;

class Router
{
    protected array $routes = [];
    public function add(string $uri, string $method, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }



    public function dispatch(string $uri, string $method): string
    {
        $route = $this->findRoute($uri, $method);
        if ($route === null) {
            return $this->notFound();
        }
        [$controller, $action] = explode('@', $route['controller']);
        return $this->callAction($controller, $action, $route['params']);
    }

    public function notFound(): string
    {
        return '404';
    }

    protected function findRoute(string $uri, string $method): ?array
    {

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                $params = $this->matchRoute($route['uri'], $uri);

                if ($params !== null) {
                    return [...$route, 'params' => $params];
                }
            }
        }

        return null;
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
        $controllerClass = "App\\Controllers\\" . $controller;
        $controllerInstance = new $controllerClass;
        return $controllerInstance->$action($params);
    }
}
