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
                              WHERE `condition`="'.ProductCondition::NewCondition.'" AND quantity > 0
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
                              WHERE `condition`="'.ProductCondition::SecondHand.'" AND quantity > 0
                              ORDER BY added_on LIMIT '.$productCount.'';
        $secondHandProducts = $conn->query($allSecondHandProductSql)->fetchAll();

        return $secondHandProducts;
    }

    public function getProductById($id) {
        $conn = DB::connect();

        $productByIdSql = 'SELECT name, price, description, quantity, `condition`, picture
                           FROM products WHERE id="'.$id.'"  AND quantity > 0';

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
}