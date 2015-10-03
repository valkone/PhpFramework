<?php
$websiteTitle = "Shop :: Delete Category";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <?php foreach($model["categories"] as $cat): ?>
                    <?= $cat['name']; ?> <a class="customLink" href="<?= __MAIN_URL__ . 'Categories/Delete/' . $cat['id']; ?>">Delete</a><br />
                <?php endforeach; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>