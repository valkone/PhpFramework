<?php

namespace Framework\Models;

use Framework\DB;

class CategoriesModel {

    public function getAllCategories() {
        $db = DB::connect();

        $getAllCategories = 'SELECT id, name FROM categories';
        $categories = $db->query($getAllCategories)->fetchAll();

        return $categories;
    }

    public function getProductsByCategoryId($id) {
        $db = DB::connect();

        $productsByCategorySql = '
                                SELECT
                                  p.name as ProductName,
                                  p.price as ProductPrice,
                                  p.picture as ProductPicture,
                                  c.name as CategoryName
                                FROM category_product AS cp
                                JOIN products AS p
                                ON cp.product_id = p.id
                                JOIN categories as c
                                ON cp.category_id = c.id
                                WHERE cp.category_id="'.$id.'"';
        $productsByCategory = $db->query($productsByCategorySql)->fetchAll();

        return $productsByCategory;
    }
}