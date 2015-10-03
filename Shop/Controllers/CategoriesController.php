<?php

namespace Framework\Controllers;

use Framework\Functions;
use Framework\Models\CategoriesModel;
use Framework\View;

class CategoriesController {

    public function product($id) {
        $categoriesModel = new CategoriesModel();
        try {
            $products = $categoriesModel->getProductsByCategoryId($id);
        } catch(\Exception $e) {
            header("Location: " . __MAIN_URL__ . __HOME_DIRECTORY__);
            exit;
        }
        $model["products"] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function add(){
        Functions::EditorAuthorization();

        if(isset($_POST['categoryButton'])) {
            $category = $_POST['category'];

            $categoryModel = new CategoriesModel();
            $categoryModel->add($category);
        }

        return new View();
    }

    public function delete($categoryId = null) {
        Functions::EditorAuthorization();

        if($categoryId) {
            $categoryModel = new CategoriesModel();
            $categoryModel->delete($categoryId);
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}