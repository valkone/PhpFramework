<?php
require 'Views/header.php';
?>
    <div id="content">
        <div id="aside">
            <div class="label">CATEGORY</div>
            <ul>
                <a href="#"><li>LAPTOP</li></a>
                <a href="#"><li>KEYBOARD</li></a>
                <a href="#"><li>TABLET</li></a>
                <a href="#"><li>FASHION</li></a>
                <a href="#"><li>TELEVISION</li></a>
                <a href="#"><li>PHONE</li></a>
                <a href="#"><li>GAME</li></a>
            </ul>
        </div>
        <div id="main-content">
            <div id="form">
                <form method="post">
                    Name:
                    <?php
                    \Framework\ViewHelpers\TextField::create()
                        ->addAttribute("name", "name")
                        ->render();
                    ?>
                    Password:
                    <?php
                    \Framework\ViewHelpers\TextField::create()
                        ->addAttribute("name", "password")
                        ->render();
                    ?>
                    <input type="submit" value="Login" name="loginButton" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>