<?php
$websiteTitle = "Shop :: Add Product";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <form method="post">
                    <p>Name:</p>
                    <input class="customInput" type="text" name="name" />
                    <p>Price:</p>
                    <input class="customInput" type="text" name="price" />
                    <p>Description:</p>
                    <textarea rows="5" cols="42" name="desc"></textarea>
                    <p>Quantity:</p>
                    <input class="customInput" type="text" name="quantity" />
                    <p>Condition:</p>
                    <select name="condition">
                        <option value="1">New</option>
                        <option value="2">Second Hand</option>
                    </select>
                    <p>Picture(URL):</p>
                    <input class="customInput" type="text" name="pic" />
                    <p>Category:</p>
                    <select name="category">
                        <?php foreach($model['categories'] as $category): ?>
                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <br />
                    <input class="customButton" type="submit" value="Add Item" name="addItemButton"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>