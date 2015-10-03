<?php
$websiteTitle = "Shop :: Register";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <div id="form">
                    <form method="post">
                        <p>Username:</p> <input class="customInput" type="text" name="username" /><br />
                        <p>Password:</p> <input class="customInput" type="password" name="pass" /><br />
                        <p>Confirm Password:</p> <input type="password" class="customInput" name="confirmPass" /><br />
                        <p>Email:</p> <input type="text" name="email" class="customInput" /><br /><br />
                        <input type="submit" value="Register" class="customButton" name="registerButton" />
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>