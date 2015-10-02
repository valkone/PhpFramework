<?php

namespace Framework\Models;

use Framework\DB;
use Framework\Models\BindingModels\ProductBindingModel;
use Framework\ProductCondition;
use Framework\View;

class ProductsModel {

    /**
     * @param $productCount
     * @return array
     */
    public function getLastNewProducts($productCount) {
        $conn = DB::connect();

        $allNewProductSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE `condition`="'.ProductCondition::NewCondition.'" AND quantity > 0 AND isDeleted = 0
                              ORDER BY added_on LIMIT '.$productCount.'';
        $newProducts = $conn->query($allNewProductSql)->fetchAll();

        return $newProducts;
    }

    /**
     * @param $productCount
     * @return array
     */
    public function getLastSecondHandProducts($productCount) {
        $conn = DB::connect();

        $allSecondHandProductSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE `condition`="'.ProductCondition::SecondHand.'" AND quantity > 0 AND isDeleted = 0
                              ORDER BY added_on LIMIT '.$productCount.'';
        $secondHandProducts = $conn->query($allSecondHandProductSql)->fetchAll();

        return $secondHandProducts;
    }

    public function getAllProducts() {
        $conn = DB::connect();

        $allProductsSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE quantity > 0 AND isDeleted = 0
                              ORDER BY added_on';
        $allProducts = $conn->query($allProductsSql)->fetchAll();

        return $allProducts;
    }

    public function getProductById($id) {
        $conn = DB::connect();

        $productByIdSql = 'SELECT
                                p.name,
                                p.price,
                                p.description,
                                p.quantity,
                                p.`condition`,
                                p.picture,
                                c.name as CategoryName,
                                c.id as CategoryId,
                                p.id as ProductId
                           FROM products as p
                           JOIN category_product as cp
                           ON p.id = cp.product_id
                           JOIN categories as c
                           ON c.id = cp.category_id
                           WHERE p.id="'.$id.'"  AND p.quantity > 0 AND p.isDeleted = 0';

        $product = $conn->query($productByIdSql)->fetch();

        if(!$product) {
            throw new \Exception("Invalid product");
        }

        return $product;
    }

    public function addProduct(ProductBindingModel $p) {
        $conn = DB::connect();

        $insertProductSql = 'INSERT INTO products(name, price, added_on, description, quantity, `condition`, picture)
                            VALUES(
                              "'.$p->getName().'",
                              "'.$p->getPrice().'",
                              "'.time().'",
                              "'.$p->getDescription().'",
                              "'.$p->getQuantity().'",
                              "'.$p->getCondition().'",
                              "'.$p->getPicture().'"
                              )';
        if(!$conn->query($insertProductSql)) {
            throw new \Exception("Database error");
        }

        $getProductId = $conn->query('SELECT id FROM products WHERE name="'.$p->getName().'" ORDER BY added_on DESC LIMIT 1')->fetch();

        $addCategorySql = 'INSERT INTO category_product(category_id, product_id)
                            VALUES("'.$p->getCategory().'", "'.$getProductId["id"].'")';
        if(!$conn->query($addCategorySql)) {
            throw new \Exception("Database error");
        }

        View::$viewBag['productAdded'] = true;
    }

    public function deleteProductById($id) {
        $conn = DB::connect();

        $validIdSql = 'SELECT id FROM products WHERE id="'.$id.'"';
        if($conn->query($validIdSql)->rowCount() == 0) {
            throw new \Exception("Invalid product");
        }

        $deleteProductSql = 'UPDATE products SET isDeleted=1 WHERE id="'.$id.'"';
        if(!$conn->query($deleteProductSql)){
            throw new \Exception("Database error");
        }

        View::$viewBag['productDeleted'] = true;
    }

    public function editProduct($id, $quantity, $category, $oldCategory) {
        $db = DB::connect();

        $checkIfCategoryIsValidSql = 'SELECT id FROM categories WHERE id="'.$category.'"';
        if($db->query($checkIfCategoryIsValidSql)->rowCount() == 0) {
            throw new \Exception("Invalid category");
        }

        $editQuantitySql = 'UPDATE products SET quantity = "'.$quantity.'" WHERE id = "'.$id.'"';
        if(!$db->query($editQuantitySql)) {
            throw new \Exception("Database error");
        }

        $editCategorySql = 'UPDATE category_product SET category_id = "'.$category.'"
                            WHERE product_id = "'.$id.'" AND category_id = "'.$oldCategory.'"';
        if(!$db->query($editCategorySql)) {
            throw new \Exception("Database error");
        }

        View::$viewBag['edited'] = true;
    }

    public function addToCard($productId, $quantity, $productName) {
        $db = DB::connect();

        if(isset($_SESSION['cart']['products'][$productId])) {
            $cardQuantity = $_SESSION['cart']['products'][$productId]["quantity"] + $quantity;
        } else {
            $cardQuantity = $quantity;
        }

        $getProductQuantitySql = 'SELECT quantity FROM products WHERE id="'.$productId.'"';
        $product = $db->query($getProductQuantitySql);

        if($product->rowCount() == 0) {
            throw new \Exception("Invalid product");
        }

        $productQuantity = $product->fetch()["quantity"];
        if($cardQuantity > $productQuantity) {
            throw new \Exception("Invalid quantity");
        }

        $_SESSION['cart']['products'][$productId]["quantity"] = $cardQuantity;
        $_SESSION['cart']['products'][$productId]["name"] = $productName;

        View::$viewBag['added'] = true;
    }

    public function getUserProducts($id) {
        $db = DB::connect();

        $userProductsSql = 'SELECT
                              pu.quantity as productQuantity,
                              p.name as productName,
                              p.price as productPrice,
                              p.id as productId
                            FROM product_user as pu
                            JOIN products as p
                            ON p.id = pu.product_id';

        $products =  $db->query($userProductsSql)->fetchAll();

        return $products;
    }

    public function sellUserProducts($userId, $productId) {
        // TODO: this method
    }

    public function addReview($productId, $review, $userId)
    {
        $db = DB::connect();

        $errors = [];
        if (strlen($review) == 0 || strlen($review) > 1000) {
            $errors[] = "Invalid review";
        }

        $isProductValidSql = 'SELECT id FROM products WHERE id="' . $productId . '"';
        if ($db->query($isProductValidSql)->rowCount() == 0) {
            $errors[] = "Invalid product";
        }

        if (count($errors) == 0) {
            $addReviewSql = 'INSERT INTO reviews(review, product_id, user_id)
                        VALUES("' . $review . '", "' . $productId . '", "' . $userId . '")';
            $db->query($addReviewSql);
            View::$viewBag['successMessage'] = "Successfully added review";
        } else {
            View::$viewBag['errors'] = $errors;
        }
    }

    public function getProductReviews($productId) {
        $db = DB::connect();

        $getProductReviewsSql = 'SELECT
                                    r.review as review,
                                    u.username as user
                                 FROM reviews as r
                                 JOIN users as u
                                 ON u.id = r.user_id';

        $reviews = $db->query($getProductReviewsSql)->fetchAll();

        return $reviews;
    }
}