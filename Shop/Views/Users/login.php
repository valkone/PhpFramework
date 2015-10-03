<?php
$websiteTitle = "Shop :: Login";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                <?php
                    if(isset(self::$viewBag["error"])) {
                        echo '<div class="error">';
                        echo self::$viewBag["error"];
                        echo "</div>";
                    }
                ?>
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