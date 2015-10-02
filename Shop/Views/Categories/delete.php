<?php
$websiteTitle = "Shop :: Delete Category";
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
                <?php if(isset(self::$viewBag["added"])): ?>
                    <div class="success">Category successfully deleted</div>
                <?php endif; ?>
                <?php foreach($model["categories"] as $cat): ?>
                    <?= $cat['name']; ?><a href="<?= __MAIN_URL__ . 'Categories/Delete/' . $cat['id']; ?>">Delete</a><br />
                <?php endforeach; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>