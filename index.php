<?php

namespace Framework;

session_start();

require_once 'configurations/routers.php';
require_once 'configurations/main.php';
require_once 'Token.php';
require_once 'configurations/areas.php';

Token::generateToken();

echo $_SESSION['token'];
$uri = $_GET['uri'];
foreach($customRouters as $route) {
    $pattern = '/^' . str_replace('/', '\/', $route->getRoute()) . '/';
    if (preg_match($pattern, $uri, $matches, PREG_OFFSET_CAPTURE)) {
        $controller = $route->getController();
        $action = $route->getAction();
        $requestUri = str_replace($route->getRoute(), '', $uri);
        $requestUri = explode('/', $requestUri);
        $requestUri = array_filter($requestUri);
        $controllerNamespace = '\\Framework\\Controllers\\';

        break;
    }
}

if(!isset($controller)) {
    $urlSplit = explode('/', $uri);
    if (count($urlSplit) >= 3) {
        $requestUri = explode("/", $uri);
        $possibleAreas = $urlSplit[0];
        if (in_array($possibleAreas, $areas)) {
            $area = array_shift($requestUri);
            $controller = array_shift($requestUri);
            $action = array_shift($requestUri);
            $controllerNamespace = '\\Framework\\Areas\\' . ucfirst($area) . '\\Controllers\\';
        }
    }
}

if(!isset($controller)) {
    $requestUri = explode("/", $uri);
    $controller = array_shift($requestUri);
    $action = array_shift($requestUri);
    $controllerNamespace = '\\Framework\\Controllers\\';
}

$controllerName = $controllerNamespace . ucfirst($controller) . 'Controller';

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