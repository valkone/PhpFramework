<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\Models\ProductsModel;
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

            $userModel = new UsersModels();
            $userModel->register($username, $pass, $confirmPass, $email);
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function Profile() {
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        $usersModel = new UsersModels();
        $userInfo = $usersModel->getUserInfo($_SESSION['username']);
        $model["userInfo"] = $userInfo;

        return new View($model);
    }

    public function Logout() {
        session_destroy();
        header("Location: " . __MAIN_URL__ . "/Home/home");
        exit;
    }

    public function Products() {
        $usersModel = new ProductsModel();
        $products = $usersModel->getUserProducts($_SESSION['id']);
        $model["products"] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}