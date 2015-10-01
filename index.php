<?php

namespace Framework;

session_start();

require_once 'configurations/routers.php';
require_once 'configurations/main.php';
require_once 'Token.php';
require_once 'configurations/areas.php';

if(!isset($_SESSION['token'])) {
    Token::generateToken();
} else {
    Token::setToken($_SESSION['token']);
}

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

Token::tokenValidationCheck();

$refc = new \ReflectionClass($controllerName);
$method = $refc->getMethod($action);
if(count($method->getParameters()) > 0 && is_object($method->getParameters()[0])) {
    $propertyObject = $method->getParameters()[0]->getClass();
    if(is_object($propertyObject)) {
        $properties = $propertyObject->getProperties();

        foreach($properties as $property) {
            if(!isset($_POST[$property->getName()])) {
                throw new \Exception("Invalid properties for binding model");
            }
        }

        $bindingModelName = $propertyObject->getName();
        $bindingModelObject = new $bindingModelName;
        foreach($properties as $property) {
            $method = 'set' . ucfirst($property->getName());
            $bindingModelObject->$method($_POST[$property->getName()]);
        }

        $requestUri = array();
        $requestUri[0] = $bindingModelObject;
    }
}

$methodDoc = $method->getDocComment();
preg_match_all('/@[a-zA-Z]+/', $methodDoc, $matches);
foreach($matches[0] as $match) {
    if(strtolower($match) == "@get") {
        if(strtolower($_SERVER['REQUEST_METHOD']) != "get") {
            throw new \Exception("This method can be called only on GET");
        }
    } else if(strtolower($match) == "@post") {
        if(strtolower($_SERVER['REQUEST_METHOD']) != "post") {
            throw new \Exception("This method can be called only on GET");
        }
    } else if(strtolower($match) == "@put") {
        if(strtolower($_SERVER['REQUEST_METHOD']) != "put") {
            throw new \Exception("This method can be called only on GET");
        }
    } else if(strtolower($match) == "@delete") {
        if(strtolower($_SERVER['REQUEST_METHOD']) != "delete") {
            throw new \Exception("This method can be called only on GET");
        }
    }
}

$controllerInstance = new $controllerName();

call_user_func_array(
    array($controllerInstance, $action),
    $requestUri
);