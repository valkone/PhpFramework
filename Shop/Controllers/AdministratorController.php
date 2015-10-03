<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\Models\ProductsModel;
use Framework\Models\UsersModels;
use Framework\View;

class AdministratorController {

    /**
     * @return View
     * @admin
     */
    public function banUser() {
        if(isset($_POST['banButton'])) {
            $user = $_POST['username'];

            $userModel = new UsersModels();
            $userModel->banUser($user);
        }

        return new View();
    }

    /**
     * @admin
     */
    public function banIp() {
        if(isset($_POST['banButton'])) {
            $ip = $_POST['ip'];

            $userModel = new UsersModels();
            $userModel->banIp($ip);
        }

        return new View();
    }

    /**
     * @admin
     */
    public function productEdit($id) {
        $productModel = new ProductsModel();

        if(isset($_POST['editProductButton'])) {
            $name = $_POST['productName'];
            $desc = $_POST['desc'];
            $condition = $_POST['condition'];
            $quantity = $_POST['quantity'];
            $pic = $_POST['pic'];
            $category = $_POST['category'];
            $productId = $_POST['productId'];
            $oldCategory = $_POST['oldCategory'];

            $productModel->adminEditProduct($name, $desc, $condition, $quantity, $pic, $category, $productId, $oldCategory);
        }

        try {
            $product = $productModel->getProductById($id);
            $model["product"] = $product;
        } catch(\Exception $e) {
            header("Location: " . __MAIN_URL__ . __HOME_DIRECTORY__);
            exit;
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    /**
     * @admin
     */
    public function users($id = null) {
        if($id != null) {
            View::$viewBag['editing'] = $id;
        }

        if(isset($_POST['editUserButton'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $cash = $_POST['cash'];
            $userId = $_POST['userId'];

            $userModels = new UsersModels();
            $userModels->editUser($username, $email, $role, $cash, $userId);
        }

        $userModel = new UsersModels();
        $users = $userModel->getAllUsers();
        $model["users"] = $users;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    /**
     * @admin
     */
    public function editBoughtProducts($id = null) {
        if($id != null) {
            View::$viewBag['productId'] = $id;
        }

        $productModel = new ProductsModel();

        if(isset($_POST['editButton'])) {
            $quantity = $_POST['quantity'];
            $productId = $_POST['productId'];
            $userId = $_POST['userId'];

            $productModel->editBoughtProduct($quantity, $productId, $userId);

        }

        $products = $productModel->getAllBoughtProducts();
        $model['products'] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function addProductsToUser() {
        $productModel = new ProductsModel();

        if(isset($_POST['addProductButton'])) {
            $username = $_POST['username'];
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];

            $productModel->addProductToUser($username, $productId, $quantity);
        }

        $products = $productModel->getAllProducts();
        $model["products"] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}