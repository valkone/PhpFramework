<?php
$websiteTitle = "Shop :: Add Category";
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
                    <div class="success">Category successfully added</div>
                <?php endif; ?>
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