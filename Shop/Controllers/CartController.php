<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\View;

class CartController {

    public function show() {

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function delete($id) {
        unset($_SESSION['cart']['products'][$id]);
        header("Location: " . __MAIN_URL__ . "/Cart/Show");
        exit;
    }
}