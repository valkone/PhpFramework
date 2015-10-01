<?php

namespace Framework\Controllers;

use Framework\Functions;
use Framework\Models\BindingModels\ProductBindingModel;
use Framework\Models\CategoriesModel;
use Framework\Models\ProductsModel;
use Framework\View;

class ProductsController {

    public function show($id) {
        $productModel = new ProductsModel();
        try {
            $product = $productModel->getProductById($id);
        } catch(\Exception $e) {
            header("Location: " . __MAIN_URL__ . __HOME_DIRECTORY__);
            exit;
        }

        $model["product"] = $product;

        return new View($model);
    }

    public function add() {
        Functions::EditorAuthorization();

        if(isset($_POST['addItemButton'])) {
            $name = $_POST['name'];
            $price = (int)$_POST['price'];
            $desc = $_POST['desc'];
            $quantity = (int)$_POST['quantity'];
            $condition = $_POST['condition'];
            $pic = $_POST['pic'];
            $category = $_POST['category'];

            $errors = [];
            if(strlen($name) == 0) {
                $errors[] = "Invalid product name";
            }
            if($quantity == 0) {
                $errors[] = "Invalid quantity";
            }

            if(count($errors) == 0) {
                $product = new ProductBindingModel();
                $product->setName($name);
                $product->setQuantity($quantity);
                $product->setPrice($price);
                $product->setCategory($category);
                $product->setCondition($condition);
                $product->setDescription($desc);
                $product->setPicture($pic);

                $productModel = new ProductsModel();
                try {
                    $productModel->addProduct($product);
                } catch(\Exception $e) {
                    View::$viewBag['errors'] = $e->getMessage();
                }
            } else {
                View::$viewBag['errors'] = $errors;
            }
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }

    public function delete($productId = null) {
        Functions::EditorAuthorization();

        $productModel = new ProductsModel();

        if($productId) {
            try {
                $productModel->deleteProductById($productId);
            } catch(\Exception $e) {
                $model['error'] = $e->getMessage();
            }
        }

        $products = $productModel->getAllProducts();
        $model['products'] = $products;

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}