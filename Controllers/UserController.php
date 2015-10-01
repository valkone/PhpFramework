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
        $user = new UserModel();
        $model = $user->getAll();

        return new View($model);
    }

    public function getAll() {
        $user = new UserModel();
        $model = $user->getAll();

        return new View($model);
    }

    public function testToken() {
        echo 'OK';
    }

    public function testBinding(MyBind $model) {
        echo '<pre>'.print_r($model, true).'</pre>';
        echo $model->getName();
    }

    /**
     * @see testToken
     * @GET
     */
    public static function testGetAnnotations() {
        //$_SERVER['REQUEST_METHOD']
        echo 'test';
    }
}

class MyBind {
    private $id;
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }
}