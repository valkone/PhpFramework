<?php

namespace Framework\Controllers;

use Framework\View;
use Framework\ViewModels\UserEditViewModel;

class UserController {

    protected function onInit() {
        View::$viewBag["password"] = "parolata";
    }

    public function edit($id, $name) {
        $model = new UserEditViewModel($id, $name);

        return new View($model);
    }
}