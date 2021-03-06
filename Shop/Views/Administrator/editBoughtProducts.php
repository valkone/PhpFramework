<?php
$websiteTitle = "Shop :: Products";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="product-section">
                <div class="label">Edit Bought Products</div>
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>

                <?php if(isset(self::$viewBag['productId'])): ?>
                        <?php $productKey = self::$viewBag['productId']; ?>
                    <br />
                        <form method="post">
                            <input type="text" name="quantity" class="customInput" value="<?= $model['products'][$productKey]["quantity"]; ?>" />
                            <input type="hidden" name="productId" value="<?= $model['products'][$productKey]["product_id"]; ?>" />
                            <input type="hidden" name="userId" value="<?= $model['products'][$productKey]["userId"]; ?>" />
                            <input type="submit" class="customButton" value="Edit" name="editButton" />
                        </form><br />
                <?php endif; ?>
                <?php $productCount = 0; ?>
                <?php foreach($model['products'] as $product): ?>
                    <a class="customLink" href="<?= __MAIN_URL__ . "Products/Show/" . $product['product_id']; ?>"><?= $product['name']; ?></a>
                    - (user: <?= $product['username']; ?>)
                    (quantity: <?= $product['quantity']; ?>)
                    - <a class="customLink" href="<?= __MAIN_URL__ . "Administrator/EditBoughtProducts/" . $productCount++; ?>">Edit</a><br />
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>