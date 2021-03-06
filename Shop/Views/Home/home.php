<?php
$websiteTitle = "Shop :: Home";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="product-section">
                <div class="label">NEW PRODUCTS</div>
                <?php foreach($model["newProducts"] as $newProduct): ?>
                    <div class="product">
                        <a href="<?= __MAIN_URL__ .  "Products/Show/" . $newProduct["id"]; ?>">
                            <div class="product-image">
                                <img src="<?php
                                if(strlen($newProduct['picture']) == 0) {
                                    echo __DEFAULT_PICTURE__;
                                } else {
                                    echo $newProduct['picture'];
                                }
                                ?>" />
                            </div>
                            <div class="product-name">
                                <?= $newProduct["name"]; ?>
                            </div>
                            <div class="product-price">
                                $ <?= $newProduct["price"]; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
            <div class="product-section">
                <div class="label">Second Hand Products</div>
                <?php foreach($model["secondHandProducts"] as $secondHandProduct): ?>
                    <div class="product">
                        <a href="<?= __MAIN_URL__ .  "Products/Show/" . $secondHandProduct["id"]; ?>">
                            <div class="product-image">
                                <img src="<?php
                                if(strlen($secondHandProduct['picture']) == 0) {
                                    echo __DEFAULT_PICTURE__;
                                } else {
                                    echo $secondHandProduct['picture'];
                                }
                                ?>" />
                            </div>
                            <div class="product-name">
                                <?= $secondHandProduct["name"]; ?>
                            </div>
                            <div class="product-price">
                                $ <?= $secondHandProduct["price"]; ?>
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