<?php

namespace Framework;

class View {

    public static $controllerName;
    public static $actionName;
    public static $viewBag = [];

    public function __construct() {

        $args = func_get_args();
        if(count($args) == 2) {
            self::loadViewAndModel($args[0], $args[1]);
        } else if(count($args) == 1) {
            self::loadOnlyModel($args[0]);
        } else if(count($args) == 0) {
            self::loadViewOnly();
        }

    }

    private static function loadViewAndModel($view, $model) {
        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        $view = str_replace('\\', DIRECTORY_SEPARATOR, $view);

        require 'Views'
            . DIRECTORY_SEPARATOR
            . $view
            . '.php';
    }

    private static function loadOnlyModel($model) {
        require 'Views'
            . DIRECTORY_SEPARATOR
            . self::$controllerName
            . DIRECTORY_SEPARATOR
            . self::$actionName
            . '.php';
    }

    private static function loadViewOnly() {
        require 'Views'
            . DIRECTORY_SEPARATOR
            . self::$controllerName
            . DIRECTORY_SEPARATOR
            . self::$actionName
            . '.php';
    }
}