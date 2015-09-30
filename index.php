<?php

namespace Framework;

require_once 'Routers.php';

$uri = $_GET['uri'];
$customRouterFound = false;
foreach($customRouters as $route) {
    $pattern = '/^' . str_replace('/', '\/', $route->getRoute()) . '/';
    if (preg_match($pattern, $uri, $matches, PREG_OFFSET_CAPTURE)) {
        $controller = $route->getController();
        $action = $route->getAction();
        $requestUri = str_replace($route->getRoute(), '', $uri);
        $requestUri = explode('/', $requestUri);
        $requestUri = array_filter($requestUri);
        $customRouterFound = true;

        break;
    }
}

if(!$customRouterFound) {
    $requestUri = explode("/", $uri);
    $controller = array_shift($requestUri);
    $action = array_shift($requestUri);
}

$controllerName = '\\Framework\\Controllers\\' . ucfirst($controller) . 'Controller';

spl_autoload_register(function($class) {
    $splitted = explode("\\", $class);
    array_shift($splitted);
    $fullClassName = implode(DIRECTORY_SEPARATOR, $splitted);

    require_once $fullClassName . '.php';
});

View::$controllerName = $controller;
View::$actionName = $action;

$controllerInstance = new $controllerName();

call_user_func_array(
    array($controllerInstance, $action),
    $requestUri
);