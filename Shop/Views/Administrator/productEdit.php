<?php
$websiteTitle = "Shop :: Edit Product";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                Edit: <b><?= $model['product']['name']; ?></b><br /><br />
                <form method="post">
                    <p>Name:</p>
                    <input class="customInput" type="text" name="productName" value="<?= $model['product']['name']; ?>" />
                    <p>Description:</p>
                    <textarea rows="5" cols="42" name="desc"><?= $model['product']['description']; ?></textarea>
                    <p>Condition:</p>
                    <select name="condition">
                        <option value="1" <?php echo $model['product']['condition'] == 1 ? "selected" : "" ?>>New</option>
                        <option value="2" <?php echo $model['product']['condition'] == 2 ? "selected" : "" ?>>Second Hand</option>
                    </select>
                    <p>Quantity:</p>
                    <input type="text" class="customInput" name="quantity" value="<?= $model['product']['quantity']; ?>" />
                    <p>Picture:</p>
                    <input type="text" class="customInput" name="pic" value="<?= $model['product']['picture']; ?>" />
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
                    <input type="hidden" name="productId" value="<?= $model['product']['ProductId'];  ?>" /><br />
                    <input type="submit" class="customButton" value="Edit Product" name="editProductButton"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>