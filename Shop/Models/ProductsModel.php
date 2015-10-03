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

        View::$viewBag['successMessage'] = "Product successfully added";
    }

    public function deleteProductById($id) {
        $conn = DB::connect();

        $validIdSql = 'SELECT id FROM products WHERE id="'.$id.'"';
        if($conn->query($validIdSql)->rowCount() == 0) {
            View::$viewBag["errors"][] = "Invalid product";
        } else {
            $deleteProductSql = 'UPDATE products SET isDeleted=1 WHERE id="'.$id.'"';
            if(!$conn->query($deleteProductSql)){
                throw new \Exception("Database error");
            }

            View::$viewBag['successMessage'] = "Product successfully deleted";
        }
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

        View::$viewBag['successMessage'] = "Product successfully edited";
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

        View::$viewBag['successMessage'] = "Product successfully added in your cart";
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
                            ON p.id = pu.product_id
                            WHERE pu.user_id = "'.$id   .'"';

        $products =  $db->query($userProductsSql)->fetchAll();

        return $products;
    }

    public function getAllUserProducts() {
        $db = DB::connect();

        $userProductsSql = 'SELECT
                              pu.quantity as productQuantity,
                              p.name as productName,
                              p.price as productPrice,
                              p.id as productId,
                              pu.user_id as userId,
                              u.username as username
                            FROM product_user as pu
                            JOIN products as p
                            ON p.id = pu.product_id
                            JOIN users as u
                            ON u.id = pu.user_id';

        $products =  $db->query($userProductsSql)->fetchAll();

        return $products;
    }

    public function sellUserProducts($userId, $productId, $quantity, $price) {
        $db = DB::connect();

        $checkProductUserSql = 'SELECT user_id FROM product_user WHERE product_id = "'.$productId.'"
                                AND user_id = "'.$userId.'" AND quantity = "'.$quantity.'"';
        $errors = [];
        if($db->query($checkProductUserSql)->rowCount() == 0) {
            $errors[] = "Invalid product or product quantity";
        }

        $checkProductPriceSql = 'SELECT price FROM products WHERE id = "'.$productId.'"';
        if($db->query($checkProductPriceSql)->fetch()["price"] != $price) {
            $errors[] = "Invalid price";
        }

        if(count($errors) == 0) {
            $deleteProductUserSql = 'DELETE FROM product_user WHERE product_id = "'.$productId.'"
                                    AND user_id = "'.$userId.'" AND quantity = "'.$quantity.'"';
            $db->query($deleteProductUserSql);

            $newCash = $quantity * $price;
            $changeUserCashSql = 'UPDATE users SET cash = cash + '.$newCash.' WHERE id = "'.$userId.'"';
            $db->query($changeUserCashSql);

            $addProductQuantitySql = 'UPDATE products SET quantity = quantity + '.$quantity.' WHERE id = "'.$productId.'"';
            $db->query($addProductQuantitySql);

            View::$viewBag['successMessage'] = "Products was sold";
        } else {
            View::$viewBag['errors'] = $errors;
        }
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
                                 ON u.id = r.user_id
                                 WHERE r.product_id = "'.$productId.'"';

        $reviews = $db->query($getProductReviewsSql)->fetchAll();

        return $reviews;
    }

    public function adminEditProduct($name, $desc, $condition, $quantity, $pic, $category, $productId, $oldCategory) {
        $errors = [];
        if($quantity <= 0) {
            $errors[] = "Invalid quantity";
        }
        if($category == 0) {
            $errors[] = "Invalid category";
        }

        if(count($errors) == 0) {
            $db = DB::connect();

            $editProduct = 'UPDATE products SET
                              name = "'.$name.'",
                              description = "'.$desc.'",
                              `condition` = "'.$condition.'",
                              quantity = "'.$quantity.'",
                              picture = "'.$pic.'"
                            WHERE id = "'.$productId.'"';
            $db->query($editProduct);

            $editCategory = 'UPDATE category_product SET category_id = "'.$category.'" WHERE
                             category_id = "'.$oldCategory.'" AND product_id = "'.$productId.'"';
            $db->query($editCategory);

            View::$viewBag['successMessage'] = "Product edited";
        } else {
            View::$viewBag['errors'] = $errors;
        }
    }

    public function getAllBoughtProducts() {
        $db = DB::connect();

        $getProductsSql = 'SELECT
                              pu.quantity,
                              u.username,
                              u.id as userId,
                              p.name,
                              pu.product_id
                           FROM product_user as pu
                           JOIN users as u
                           ON u.id = pu.user_id
                           JOIN products as p
                           ON p.id = pu.product_id';
        $products = $db->query($getProductsSql)->fetchAll();

        return $products;
    }

    public function editBoughtProduct($quantity, $productId, $userId) {
        $errors = [];

        if($quantity <= 0) {
            $errors[] = "Invalid quantity";
        }

        if(count($errors) == 0) {
            $db = DB::connect();

            $editProductSql = 'UPDATE product_user SET quantity = "'.$quantity.'"
                                WHERE product_id = "'.$productId.'" AND user_id = "'.$userId.'"';
            $db->query($editProductSql);

            View::$viewBag["successMessage"] = "Product Edited";
        } else {
            View::$viewBag['errors'] = $errors;
        }
    }
}