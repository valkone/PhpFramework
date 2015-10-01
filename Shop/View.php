<?php

namespace Framework;

class View {

    public static $controllerName;
    public static $actionName;
    public static $viewBag = [];
    public static $area;

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
        if(__ESCAPING__) {
            $model = self::escapeAll($model);
        }

        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        $view = str_replace('\\', DIRECTORY_SEPARATOR, $view);

        if(isset(self::$area)) {
            $path =
                'Areas'
                . DIRECTORY_SEPARATOR
                . self::$area
                . DIRECTORY_SEPARATOR
                . 'Views'
                . DIRECTORY_SEPARATOR
                . $view
                . '.php';
        } else {
            $path = 'Views'
                . DIRECTORY_SEPARATOR
                . $view
                . '.php';
        }

        self::strongTypeViewCheck($path, $model);

        require $path;
    }

    private static function loadOnlyModel($model) {
        if(__ESCAPING__) {
            $model = self::escapeAll($model);
        }

        if(isset(self::$area)) {
            $path =
                'Areas'
                . DIRECTORY_SEPARATOR
                . self::$area
                . DIRECTORY_SEPARATOR
                . 'Views'
                . DIRECTORY_SEPARATOR
                . self::$controllerName
                . DIRECTORY_SEPARATOR
                . self::$actionName
                . '.php';
        } else {
            $path = 'Views'
                . DIRECTORY_SEPARATOR
                . self::$controllerName
                . DIRECTORY_SEPARATOR
                . self::$actionName
                . '.php';
        }

        self::strongTypeViewCheck($path, $model);

        require $path;
    }

    private static function loadViewOnly() {
        if(isset(self::$area)) {
            $path = 'Areas'
            . DIRECTORY_SEPARATOR
            . self::$area
            . DIRECTORY_SEPARATOR
            . 'Views'
            . DIRECTORY_SEPARATOR
            . self::$controllerName
            . DIRECTORY_SEPARATOR
            . self::$actionName
            . '.php';
        } else {
            $path = 'Views'
                . DIRECTORY_SEPARATOR
                . self::$controllerName
                . DIRECTORY_SEPARATOR
                . self::$actionName
                . '.php';
        }

        require $path;
    }

    private static function strongTypeViewCheck($path, $model) {
        $f = fopen($path, 'r');
        $line = fgets($f);
        fclose($f);
        preg_match('/ [a-zA-Z\\\\]+ /', $line, $match, PREG_OFFSET_CAPTURE);
        if(count($match) > 0) {
            $type = $match[0][0];
            if(get_class($model) != trim($type)) {
                throw new \Exception("Wrong type supplied");
            }
        }
    }

    private static function escapeAll(&$toEscape) {
        if(is_array($toEscape)) {
            foreach($toEscape as $key => &$value) {
                if(is_object($value)) {
                    $reflection = new \ReflectionClass($value);
                    $properties = $reflection->getProperties();

                    foreach($properties as &$property) {
                        $property->setAccessible(true);
                        $property->setValue($value, self::escapeAll($property->getValue($value)));
                    }
                } else if(is_array($value)) {
                    self::escapeAll($value);
                } else {
                    $value = htmlspecialchars($value);
                }
            }
        } else if(is_object($toEscape)) {
            $reflection = new \ReflectionClass($toEscape);
            $properties = $reflection->getProperties();

            foreach($properties as &$property) {
                $property->setAccessible(true);
                $property->setValue($toEscape, self::escapeAll($property->getValue($toEscape)));
            }
        } else {
            $toEscape = htmlspecialchars($toEscape);
        }

        return $toEscape;
    }
}