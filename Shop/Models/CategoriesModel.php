<?php

namespace Framework\Models;

use Framework\DB;
use Framework\View;

class CategoriesModel {

    public function getAllCategories() {
        $db = DB::connect();

        $getAllCategories = 'SELECT id, name FROM categories WHERE isDeleted = 0';
        $categories = $db->query($getAllCategories)->fetchAll();

        return $categories;
    }

    public function getProductsByCategoryId($id) {
        $db = DB::connect();

        $checkIfCategoryIsValidSql = 'SELECT isDeleted FROM categories WHERE id="'.$id.'"';
        $result = $db->query($checkIfCategoryIsValidSql);
        if($result->rowCount() == 0) {
            throw new \Exception("Invalid category id");
        } else {
            if($result->fetch()["isDeleted"] == 1) {
                throw new \Exception("Invalid category id");
            }
        }

        $productsByCategorySql = '
                                SELECT
                                  p.name as ProductName,
                                  p.price as ProductPrice,
                                  p.picture as ProductPicture,
                                  p.id as ProductId,
                                  c.name as CategoryName
                                FROM category_product AS cp
                                JOIN products AS p
                                ON cp.product_id = p.id
                                JOIN categories as c
                                ON cp.category_id = c.id
                                WHERE cp.category_id="'.$id.'" AND p.isDeleted = 0 AND quantity > 0';
        $productsByCategory = $db->query($productsByCategorySql)->fetchAll();

        return $productsByCategory;
    }

    public function add($categoryName) {
        $conn = DB::connect();

        $addCategorySql = 'INSERT INTO categories(name) VALUES("'.$categoryName.'")';

        if($conn->query($addCategorySql)) {
            View::$viewBag['successMessage'] = "Category successfully added";
        } else {
            View::$viewBag['errors'][] = "Database error";
        }
    }

    public function delete($categoryId) {
        $conn = DB::connect();

        $deleteCategorySql = 'UPDATE categories SET isDeleted = 1 WHERE id="'.$categoryId.'"';
        if($conn->query($deleteCategorySql)) {
            View::$viewBag['successMessage'] = "Category successfully deleted";
        } else {
            View::$viewBag['errors'][] = "Database error";
        }
    }
}