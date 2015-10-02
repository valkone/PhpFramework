<?php
$websiteTitle = "Shop :: Register";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
            <div id="form">
                <form method="post">
                    <p>Username:</p> <input type="text" name="username" /><br />
                    <p>Password:</p> <input type="password" name="pass" /><br />
                    <p>Confirm Password:</p> <input type="password" name="confirmPass" /><br />
                    <p>Email:</p> <input type="text" name="email" /><br /><br />
                    <input type="submit" value="Register" name="registerButton" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>