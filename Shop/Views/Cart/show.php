<?php
$websiteTitle = "Shop :: Cart";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="label">Products</div>
            <?php foreach($_SESSION['cart']['products'] as $id => $product): ?>
                <a href="<?= __MAIN_URL__ . "Products/Show/" . $id; ?>"><?= $product['name']; ?></a> - quantity(<?= $product['quantity']; ?>)
                <a href="<?= __MAIN_URL__ . "Cart/Delete/" . $id; ?>">Remove</a><br />
            <?php endforeach; ?>
            <a href="<?= __MAIN_URL__ . "Cart/Checkout"; ?>">Checkout</a>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>