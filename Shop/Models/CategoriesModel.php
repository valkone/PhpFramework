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
}