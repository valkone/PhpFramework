<?php

namespace Framework\Controllers;

use Framework\Models\UserModel;
use Framework\View;
use Framework\ViewModels\UserEditViewModel;

class UserController extends BaseController{

    protected function onInit() {
        View::$viewBag["password"] = "parolata";
    }

    public function edit($id, $name) {
        $model = new UserEditViewModel($id, $name);

        return new View($model);
    }

    public function getAll() {
        $user = new UserModel();
        $model = $user->getAll();

        return new View($model);
    }
}