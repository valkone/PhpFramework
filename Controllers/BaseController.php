<?php

namespace Framework\Controllers;

abstract class BaseController {

    public function __construct() {
        $this->onInit();
    }

    protected function onInit() {

    }
}