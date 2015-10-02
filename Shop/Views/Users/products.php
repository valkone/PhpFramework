<?php
$websiteTitle = "Shop :: My Product";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="label">Products</div>
            <?php foreach($model["products"] as $product): ?>
                <a href="<?= __MAIN_URL__ . "Products/Show/" . $product["productId"]; ?>"><?= $product["productName"]; ?></a>
                (quantity: <?= $product["productQuantity"] ?>) (price: <?= $product["productPrice"]; ?>)<br />
            <?php endforeach; ?>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>