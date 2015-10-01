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
                    <?php
                        if(isset(self::$viewBag["errors"]) && count(self::$viewBag["errors"]) > 0) {
                            ?><div class="errors"><?php
                                foreach(self::$viewBag["errors"] as $error) {
                                    echo $error."<br />";
                                }
                            ?></div><?php
                        } else if(isset(self::$viewBag["registered"]) && self::$viewBag["registered"]) {
                            echo "You successfully registered. Please log-in.";
                        }
                    ?>
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