<?php

namespace Framework\Controllers;

use Framework\Models\CategoriesModel;
use Framework\View;

class CategoriesController {

    public function product($id) {
        $categoriesModel = new CategoriesModel();
        $products = $categoriesModel->getProductsByCategoryId($id);
        $model["products"] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}