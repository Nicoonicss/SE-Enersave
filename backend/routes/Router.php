<?php

namespace Enersave\Router;

/**
 * Simple Router
 * Single Responsibility: Route requests to appropriate controllers
 */
class Router
{
    private array $routes = [];

    /**
     * Add a route
     */
    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    /**
     * Add GET route
     */
    public function get(string $path, callable $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    /**
     * Add POST route
     */
    public function post(string $path, callable $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    /**
     * Add PUT route
     */
    public function put(string $path, callable $handler): void
    {
        $this->add('PUT', $path, $handler);
    }

    /**
     * Add DELETE route
     */
    public function delete(string $path, callable $handler): void
    {
        $this->add('DELETE', $path, $handler);
    }

    /**
     * Dispatch request to appropriate handler
     */
    public function dispatch(string $requestMethod, string $requestUri): void
    {
        // Parse URI
        $parsedUrl = parse_url($requestUri);
        $path = $parsedUrl['path'] ?? '/';

        // Find matching route
        foreach ($this->routes as $route) {
            $pattern = $this->convertToRegex($route['path']);
            
            if ($route['method'] === $requestMethod && preg_match($pattern, $path, $matches)) {
                // Extract parameters
                array_shift($matches);
                call_user_func_array($route['handler'], $matches);
                return;
            }
        }

        // No route found
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Route not found'
        ]);
    }

    /**
     * Convert route path to regex pattern
     */
    private function convertToRegex(string $path): string
    {
        $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $path);
        return '#^' . $pattern . '$#';
    }
}

