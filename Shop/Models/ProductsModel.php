<?php

namespace Framework\Models;

use Framework\DB;
use Framework\ProductCondition;

class ProductsModel {

    /**
     * @param $productCount
     * @return array
     */
    public function getLastNewProducts($productCount) {
        $conn = DB::connect();

        $allNewProductSql = 'SELECT id, name, price, description, quantity, picture FROM products
                              WHERE `condition`="'.ProductCondition::NewCondition.'"
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
                              WHERE `condition`="'.ProductCondition::SecondHand.'"
                              ORDER BY added_on LIMIT '.$productCount.'';
        $secondHandProducts = $conn->query($allSecondHandProductSql)->fetchAll();

        return $secondHandProducts;
    }

    public function getProductById($id) {
        $conn = DB::connect();

        $productByIdSql = 'SELECT name, price, description, quantity, `condition`, picture
                           FROM products WHERE id="'.$id.'"';

        $product = $conn->query($productByIdSql)->fetch();

        return $product;
    }
}