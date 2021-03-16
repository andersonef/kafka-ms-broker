<?php

namespace App\Bootstrap;

trait RouteDispatcherTrait
{
    public function processRoute(): string
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $route = null;

        foreach (CONFIG_ROUTES[$method] as $configRoute) {
            if (strpos($uri, $configRoute['path']) !== false) {
                $route = $configRoute;
                break;
            }
        }

        if (!$route) {
            header('HTTP 404');
            echo json_encode(['status' => 'error', 'message' => 'not found']);
        }

        $controller = new $route['controller']();
        $method = $route['method'];
        $response = json_encode($controller->$method());
        
        echo $response;
    }
}
