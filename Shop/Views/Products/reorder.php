<?php
$websiteTitle = "Shop :: My Product";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
            <div class="label">Products</div>
            <br />
            <?php foreach($model["products"] as $product): ?>
                <a class="customLink" href="<?= __MAIN_URL__ . "Products/Show/" . $product["productId"]; ?>"><?= $product["productName"]; ?></a>
                (quantity: <?= $product["productQuantity"] ?>) (price: <?= $product["productPrice"]; ?>)
                (username: <?= $product["username"]; ?>)
                <form method="post">
                    <input type="hidden" name="quantity" value="<?= $product["productQuantity"] ?>" />
                    <input type="hidden" name="price" value="<?= $product["productPrice"]; ?>" />
                    <input type="hidden" name="productId" value="<?= $product["productId"]; ?>" />
                    <input type="hidden" name="userId" value="<?= $product["userId"]; ?>" />
                    <input type="submit" class="customButton" value="Reorder" name="reorderButton" />
                </form><br />
            <?php endforeach; ?>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>