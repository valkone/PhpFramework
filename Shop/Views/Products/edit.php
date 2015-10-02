<?php
$websiteTitle = "Shop :: Edit Product";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php if(isset(self::$viewBag["errors"]) && count(self::$viewBag["errors"]) > 0): ?>
                    <?php foreach(self::$viewBag["errors"] as $error): ?>
                        <div class="error">
                            <?= $error; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if(isset(self::$viewBag["edited"])): ?>
                    <div class="success">Product successfully edited</div>
                <?php endif; ?>
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