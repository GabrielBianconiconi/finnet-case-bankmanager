<?php

namespace App\Core;

class Router
{
    protected array $routes = [];

    //GET
    public function get(string $path, string $controller, string $method): void
    {
        $this->routes['GET'][$path] = ['controller' => $controller, 'method' => $method];
    }

    //POST
    public function post(string $path, string $controller, string $method): void
    {
        $this->routes['POST'][$path] = ['controller' => $controller, 'method' => $method];
    }

    public function resolve(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        $route = $this->findRoute($method, $path);

        if ($route) {
            $controllerName = $route['action']['controller'];
            $methodName = $route['action']['method'];
            $params = $route['params'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "<h1>Erro 404: Página não encontrada</h1>";
    }

    private function findRoute(string $method, string $path): ?array
    {
        foreach ($this->routes[$method] ?? [] as $routePath => $action) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routePath);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return ['action' => $action, 'params' => $params];
            }
        }
        return null;
    }
}
