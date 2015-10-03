<?php

namespace Framework\Models;

use Framework\DB;
use Framework\View;

class CartModel {

    public function checkout() {
        $db = DB::connect();

        $products = $_SESSION['cart']['products'];
        $productsId = [];
        $productsPrice = 0;

        foreach($products as $id => $product) {
            $productsId[] = $id;

            $getProductPriceSql = 'SELECT price FROM products WHERE id="'.$id.'"';
            $productsPrice += $db->query($getProductPriceSql)->fetch()["price"] * $product["quantity"];
        }

        $userInfoSql = 'SELECT id, cash FROM users WHERE username="'.$_SESSION['username'].'"';
        $userInfo = $db->query($userInfoSql)->fetch();

        if($productsPrice > $userInfo["cash"]) {
            View::$viewBag['errors'][] = "You don't have enough money";
        } else {
            $removeUserCashSql = 'UPDATE users SET cash = cash - "'.$productsPrice.'" WHERE id="'.$userInfo['id'].'"';
            $db->query($removeUserCashSql);

            foreach($products as $id => $product) {
                $productExistsSql = 'SELECT product_id FROM product_user WHERE product_id = "'.$id.'"
                                    AND user_id = "'.$userInfo['id'].'"';

                if($db->query($productExistsSql)->rowCount() == 0) {
                    $buyProductSql = 'INSERT INTO product_user(product_id, user_id, quantity)
                              VALUES("'.$id.'", "'.$userInfo['id'].'", "'.$product["quantity"].'")';
                } else {
                    $buyProductSql = 'UPDATE product_user SET quantity = quantity + "'.$product["quantity"].'"
                                      WHERE  product_id = "'.$id.'" AND user_id = "'.$userInfo['id'].'"';
                }

                $db->query($buyProductSql);

                $removeQuantitySql = 'UPDATE products SET quantity = quantity - "'.$product["quantity"].'" WHERE id="'.$id.'"';
                $db->query($removeQuantitySql);

                unset($_SESSION['cart']['products'][$id]);
            }

            header("Location: " . __MAIN_URL__ . "Users/Products");
            exit;
        }
    }
}