<?php
$websiteTitle = "Shop :: Add Category";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <form method="POST">
                    <p>Category:</p><input type="text" class="customInput" name="category" /> <br /><br />
                    <input type="submit" value="Add Category" class="customButton" name="categoryButton"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>