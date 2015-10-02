<?php
$websiteTitle = "Shop :: Add Product";
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
                <?php if(isset(self::$viewBag["productAdded"])): ?>
                    <div class="success">Product successfully added</div>
                <?php endif; ?>
                <form method="post">
                    <p>Name:</p>
                    <input type="text" name="name" />
                    <p>Price:</p>
                    <input type="text" name="price" />
                    <p>Description:</p>
                    <textarea name="desc"></textarea>
                    <p>Quantity:</p>
                    <input type="text" name="quantity" />
                    <p>Condition:</p>
                    <select name="condition">
                        <option value="1">New</option>
                        <option value="2">Second Hand</option>
                    </select>
                    <p>Picture(URL):</p>
                    <input type="text" name="pic" />
                    <p>Category:</p>
                    <select name="category">
                        <?php foreach($model['categories'] as $category): ?>
                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <input type="submit" value="Add Item" name="addItemButton"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>