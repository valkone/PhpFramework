<?php
$websiteTitle = "Shop :: Login";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>
                <form method="post">
                    <p>Username:</p>
                    <?php
                    \Framework\ViewHelpers\TextField::create()
                        ->addAttribute("name", "username")
                        ->addAttribute("class", "customInput")
                        ->render();
                    ?>
                    <p>Password:</p>
                    <?php
                    \Framework\ViewHelpers\TextField::create()
                        ->addAttribute("name", "password")
                        ->addAttribute("class", "customInput")
                        ->render();
                    ?>
                    <br />
                    <br />
                    <input type="submit" class="customButton" value="Login" name="loginButton" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>