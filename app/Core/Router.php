<?php
namespace App\Core;
class Router {
    public function dispatch(string $route): void {
        [$controller, $action] = array_pad(explode('/', $route), 2, 'index');
        $controllerClass = 'App\\Controllers\\' . ucfirst($controller) . 'Controller';
        $actionMethod = $action . 'Action';
        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Controller not found";
            return;
        }
        $instance = new $controllerClass();
        if (!method_exists($instance, $actionMethod)) {
            http_response_code(404);
            echo "Action not found";
            return;
        }
        $instance->$actionMethod();
    }
}