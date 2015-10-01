<?php

namespace Framework\Models;

use Framework\DB;
use Framework\ProductCondition;

class ProductsModel {

    public function getAllNewProducts() {
        $conn = DB::connect();

        $allNewProductSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE `condition`="'.ProductCondition::NewCondition.'"';
        $newProducts = $conn->query($allNewProductSql)->fetchAll();

        return $newProducts;
    }

    public function getAllSecondHandProducts() {
        $conn = DB::connect();

        $allSecondHandProductSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE `condition`="'.ProductCondition::SecondHand.'"';
        $secondHandProducts = $conn->query($allSecondHandProductSql)->fetchAll();

        return $secondHandProducts;
    }
}