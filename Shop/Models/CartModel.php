<?php

namespace Framework\Models;

use Framework\DB;

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
            throw new \Exception("You don't have enough money");
        }

        $removeUserCashSql = 'UPDATE users SET cash = cash - "'.$productsPrice.'" WHERE id="'.$userInfo['id'].'"';
        $db->query($removeUserCashSql);

        foreach($products as $id => $product) {
            $buyProductSql = 'INSERT INTO product_user(product_id, user_id, quantity)
                              VALUES("'.$id.'", "'.$userInfo['id'].'", "'.$product["quantity"].'")';
            $db->query($buyProductSql);

            $removeQuantitySql = 'UPDATE products SET quantity = quantity - "'.$product["quantity"].'" WHERE id="'.$id.'"';
            $db->query($removeQuantitySql);

            unset($_SESSION['cart']['products'][$id]);
        }

        // TODO: redirect to user products
    }
}