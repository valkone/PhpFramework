<?php

namespace Framework\Areas\Forum\Controllers;

use Framework\View;

class UsersController {

    private $areaName = 'Forum';

    public function register() {
        View::$area = $this->areaName;
        return new View();
    }
}