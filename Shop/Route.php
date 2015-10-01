<?php

namespace Framework;

class Route {
    private $route;
    private $controller;
    private $action;

    public function __construct($route, $controller, $action) {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}