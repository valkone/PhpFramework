<?php
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
                <?php if(isset(self::$viewBag["successMessage"])): ?>
                    <div class="success"><?= self::$viewBag["successMessage"]; ?></div>
                <?php endif; ?>
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