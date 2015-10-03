<?php
$websiteTitle = "Shop :: Products";
require 'Views/header.php';
echo '<pre>' . print_r($model, true) . '</pre>';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="product-section">
                <div class="label">Products</div>
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>

                <form method="post">
                    <p>Username: </p>
                    <input type="text" name="username" />
                    <p>Product: </p>
                    <select>
                        <?php foreach($model['products'] as $product): ?>
                            <option value="<?= $product["id"] ?>"><?= $product["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p>Quantity:</p>
                    <input type="text" name="quantity" /><br />
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>