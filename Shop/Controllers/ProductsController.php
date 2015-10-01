<?php

namespace Framework\Controllers;

use Framework\Models\ProductsModel;
use Framework\View;

class ProductsController {

    public function show($id) {
        $productModel = new ProductsModel();
        $product = $productModel->getProductById($id);

        $model["product"] = $product;

        return new View($model);
    }
}