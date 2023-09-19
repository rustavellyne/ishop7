<?php

namespace IShop\Framework;

class Router
{
    private array $routes = [];

    private array $route = [];

    private string $defaultIndex = 'index';

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function addRoute(string $route, string $controller, string $action): void
    {
        $this->routes[$route] = compact('controller', 'action');
    }

    private function parseUrl(string $url): array
    {
        $parseUrl = parse_url($url);
        $url = $parseUrl['path'];
        $parseUrl['query'] = $parseUrl['query'] ?? '';
        $url = trim($url, '/');
        
        $parts = explode('/', $url);
        $prefix = '';
        if($parts[0] === 'admin') {
            $prefix = array_shift($parts);
        }
        
        $controller = ucfirst(!empty($parts[0]) ? $parts[0] : $this->defaultIndex);
        $action = !empty($parts[1]) ? $parts[1] : $this->defaultIndex;
        $parameters = array_slice($parts, 2);
        parse_str($parseUrl['query'], $parameters['GET']);
        return compact('controller', 'action', 'parameters', 'prefix');
    }

    public function search($request): array
    {
        $url = $request;
        if (array_key_exists($url, $this->routes)){
            return $this->routes[$url];
        }
        
        $this->route = $this->parseUrl($url);
        return $this->route;
    }
    
    public function dispatch($request)
    {
        $route = $this->search($request['REQUEST_URI']);
        /** $controller, $action, $parameters, $prefix */
        extract($route);
        $prefix = $prefix ? ucfirst($prefix) . "\\" : '';
        $controllerClass = "\\IShop\\Controller\\$prefix{$controller}Controller";
        if (class_exists($controllerClass)) {
            $class = new $controllerClass($route);
            if (!method_exists($class, $action)) { 
                throw new \Exception("Page Not Found: action => {$action}");
            }
            $reflection = new \ReflectionMethod($class, $action);
            if (!$reflection->isPublic()) {
                throw new RuntimeException("The called method is not public.");
            }
            $class->{$action}();
        } else {
            throw new \Exception("Page Not Found: $request[REQUEST_URI] | $controllerClass", 404);
        }
    }
}

