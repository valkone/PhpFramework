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

        if(isset($_POST['addToCardButton'])) {
            $quantity = (int)$_POST['quantity'];
            $productId = (int)$_POST['productId'];
            $productName = $_POST['productName'];

            $errors = [];
            if($quantity <= 0) {
                $errors[] = "Invalid quantity";
            }

            if(count($errors) == 0) {
                try {
                    $productModel->addToCard($productId, $quantity, $productName);
                } catch(\Exception $e) {
                    View::$viewBag['errors'][] = $e->getMessage();
                }
            } else {
                View::$viewBag['errors'] = $errors;
            }
        }

        if(isset($_POST['reviewButton'])) {
            if(!isset($_SESSION['is_logged'])) {
                header("Location: " . __MAIN_URL__ . __HOME_DIRECTORY__);
                exit;
            }

            $review = $_POST['review'];
            $productId = (int)$_POST['productId'];

            $productModel->addReview($productId, $review, $_SESSION['id']);
        }

        $reviews = $productModel->getProductReviews($id);
        $model['reviews'] = $reviews;

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
                $model['errors'][] = $e->getMessage();
            }
        }

        $products = $productModel->getAllProducts();
        $model['products'] = $products;

        return new View($model);
    }

    public function edit($productId) {
        Functions::EditorAuthorization();

        $productModel = new ProductsModel();
        try {
            $product = $productModel->getProductById($productId);
            $model["product"] = $product;
        } catch(\Exception $e) {
            header("Location: " . __MAIN_URL__ . __HOME_DIRECTORY__);
            exit;
        }

        if(isset($_POST['editProductButton'])) {
            $quantity = (int)$_POST['quantity'];
            $category = (int)$_POST['category'];
            $oldCategory = (int)$_POST['oldCategory'];
            $productId = (int)$_POST['productId'];

            $errors = [];
            if($quantity <= 0) {
                $errors[] = "Invalid quantity";
            }
            if($category == 0) {
                $errors[] = "Invalid category";
            }

            if(count($errors) == 0) {
                $productModel = new ProductsModel();
                try {
                    $productModel->editProduct($productId, $quantity, $category, $oldCategory);
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

    public function reorder() {
        Functions::EditorAuthorization();

        $productModel = new ProductsModel();
        $model["products"] = $productModel->getAllUserProducts();

        if(isset($_POST['reorderButton'])) {
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $productId = $_POST['productId'];
            $userId = $_POST['userId'];

            $productModel->sellUserProducts($userId, $productId, $quantity, $price);
        }

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAllCategories();
        $model["categories"] = $categories;

        return new View($model);
    }
}