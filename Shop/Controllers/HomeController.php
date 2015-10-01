<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\View;
use Framework\Models\ProductsModel;

class HomeController {

    public function home() {
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        $productsModel = new ProductsModel();
        $newProducts = $productsModel->getAllNewProducts();
        $secondHandProducts = $productsModel->getAllSecondHandProducts();
        $model["newProducts"] = $newProducts;
        $model["secondHandProducts"] = $secondHandProducts;

        return new View($model);
    }
}