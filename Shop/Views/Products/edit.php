<?php
$websiteTitle = "Shop :: Edit Product";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                Edit: <?= $model['product']['name']; ?>
                <form method="post">
                    <p>Quantity:</p>
                    <input type="text" name="quantity" value="<?= $model['product']['quantity']; ?>" />
                    <p>Category:</p>
                    <select name="category">
                        <?php foreach($model['categories'] as $category): ?>
                            <option
                                <?php
                                    if($category['id'] == $model['product']['CategoryId']) {
                                        echo 'selected';
                                    }
                                ?>
                            value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <input type="hidden" name="oldCategory" value="<?= $model['product']['CategoryId'];  ?>" />
                    <input type="hidden" name="productId" value="<?= $model['product']['ProductId'];  ?>" />
                    <input type="submit" value="Edit Product" name="editProductButton"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>