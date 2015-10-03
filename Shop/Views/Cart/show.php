<?php
$websiteTitle = "Shop :: Cart";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="label">Cart</div>
            <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
            <?php if(isset($_SESSION['cart']['products'])): ?>
                <?php foreach($_SESSION['cart']['products'] as $id => $product): ?>
                    <a href="<?= __MAIN_URL__ . "Products/Show/" . $id; ?>"><?= $product['name']; ?></a> - quantity(<?= $product['quantity']; ?>)
                    <a href="<?= __MAIN_URL__ . "Cart/Delete/" . $id; ?>">Remove</a><br />
                <?php endforeach; ?>
                <form method="post">
                    <input type="submit" value="Checkout" name="checkoutButton" />
                </form>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>