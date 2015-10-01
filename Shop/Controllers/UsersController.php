<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\Models\UsersModels;
use Framework\View;

class UsersController {

    public function Login() {
        if(isset($_POST['loginButton'])) {
            $username = $_POST['username'];
            $pass = $_POST['password'];

            $userModel = new UsersModels();
            try {
                $userModel->login($username, $pass);
            } catch(\Exception $e) {
                View::$viewBag['error'] = $e->getMessage();
            }
        }
        
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function Register() {
        if(isset($_POST['registerButton'])) {
            $username = $_POST['username'];
            $pass= $_POST['pass'];
            $confirmPass = $_POST['confirmPass'];
            $email = $_POST['email'];

            $errors = [];

            if($pass != $confirmPass) {
                $errors[] = "The passwords does not match";
            }
            if($username > 30 || strlen($username) == 0) {
                $errors[] = "Invalid username";
            }
            if(strlen($email) > 60 || strlen($email) == 0) {
                $errors[] = "Invalid email";
            }

            if(count($errors) == 0) {
                $userModel = new UsersModels();

                try {
                    $userModel->register($username, $pass, $email);
                } catch(\Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }

            View::$viewBag['errors'] = $errors;
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function Logout() {
        session_destroy();
        header("Location: " . __MAIN_URL__ . "/Home/home");
        exit;
    }
}