<?php
$websiteTitle = "Shop :: User Ban";
require 'Views/header.php';
?>
    <div id="content">
        <div id="maincontent">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <form method="post">
                    <input type="text" name="username" />
                    <input type="submit" value="Ban" name="banButton" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>