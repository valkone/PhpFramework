<?php
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="form">
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
                        ->render();
                    ?>
                    <p>Password:</p>
                    <?php
                    \Framework\ViewHelpers\TextField::create()
                        ->addAttribute("name", "password")
                        ->render();
                    ?>
                    <br />
                    <input type="submit" value="Login" name="loginButton" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>