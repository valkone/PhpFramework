<?php
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="product-section">
                <div class="label">Products</div>
                <?php foreach($model["products"] as $product): ?>
                    <div class="product">
                        <a href="<?= __MAIN_URL__ .  "Products/Show/" . $product["ProductId"]; ?>">
                            <div class="product-image">
                                <img src="images/product.jpg"/>
                            </div>
                            <div class="product-name">
                                <?= $product["ProductName"]; ?>
                            </div>
                            <div class="product-price">
                                $ <?= $product["ProductPrice"]; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>