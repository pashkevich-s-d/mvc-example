<?php

namespace PashkevichSD\MvcExample\Component;

use PashkevichSD\MvcExample\Exception\RouterException;

class Router
{
    private array $routes;

    public function __construct(
        array $routes
    ) {
        $this->routes = $routes;
    }

    public function run()
    {
        $uri = $this->getUri();
        
        if (empty($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('Requested method not found!');
        }

        $routes = $this->routes[$_SERVER['REQUEST_METHOD']];

        foreach ($routes as $routeKey => $route) {
            if(!preg_match("~$routeKey~", $uri)) {
                continue;
            }

            $internalRoute = preg_replace("~$routeKey~", $route, $uri);

            $routePath = explode('/', $internalRoute);

            $controllerName = CONTROLLER_NAMESPACE . ucfirst(array_shift($routePath)) . '\\' . ucfirst(array_shift($routePath)) . 'Controller';
            $actionName = 'action' . ucfirst(array_shift($routePath));

            if (!method_exists($controllerName, $actionName)) {
                throw new RouterException('Requested method not found!');
            }

            $actionResponse = (new $controllerName())->$actionName(...$routePath);

            return;
        }

        throw new RouterException('Requested method not found!');
    }

    private function getUri(): string
    {
        if (empty($_SERVER['REQUEST_URI'])) {
            throw new RouterException('Cannot resolve route!');
        }

        return trim($_SERVER['REQUEST_URI'], '/');
    }
}
