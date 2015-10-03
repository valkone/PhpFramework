<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?= $websiteTitle; ?></title>
    <link rel="stylesheet" href="<?= __MAIN_URL__ ?>styles/style.css" />
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div id="header">
        <div id="top-menu">
            <div id="left-top-menu">
                <tab>Welcome <span>
                        <?php
                            if(isset($_SESSION['is_logged'])) {
                                echo $_SESSION['username'];
                            } else {
                                echo "Guest";
                            }
                        ?>
                    </span></tab>
                <tab>Currency: <span>USD</span></tab>
                <tab>Language: <span>English</span></tab>
            </div>
            <div id="right-top-menu">
                <ul>
                    <?php
                        if(isset($_SESSION['is_logged'])) {
                            ?>
                            <li><tab><a href="<?= __MAIN_URL__ . "Users/Profile"; ?>">Profile</a></tab></li>
                            <li><tab><a href="<?= __MAIN_URL__ . "Cart/Show"; ?>">Cart</a></tab></li>
                            <li><tab><a href="<?= __MAIN_URL__ . "Users/Products"; ?>">Bought Products</a></tab></li>
                            <li><tab><a href="<?= __MAIN_URL__ . "Users/Logout"; ?>">Logout</a></tab></li>
                            <?php
                        } else {
                            ?>
                            <li><tab><a href="<?= __MAIN_URL__ . "Users/Login"; ?>">Login</a></tab></li>
                            <li><tab><a href="<?= __MAIN_URL__ . "Users/Register"; ?>">Register</a></tab></li>
                            <?php
                        }
                    ?>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <?php if(isset($_SESSION['admin'])): ?>
            <div id="top-menu">
                <div id="left-top-menu">
                    Admin Panel:
                </div>
                <div id="right-top-menu">
                    <ul>
                        <li><tab><a href="<?= __MAIN_URL__ . "Administrator/BanUser"; ?>">Ban User</a></tab></li>
                        <li><tab><a href="<?= __MAIN_URL__ . "Administrator/BanIp"; ?>">Ban IP</a></tab></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['admin']) || isset($_SESSION['editor'])): ?>
            <div id="top-menu">
                <div id="left-top-menu">
                    Editor Panel:
                </div>
                <div id="right-top-menu">
                    <ul>
                        <li><tab><a href="<?= __MAIN_URL__ . "Categories/Add"; ?>">Add Categories</a></tab></li>
                        <li><tab><a href="<?= __MAIN_URL__ . "Categories/Delete"; ?>">Delete Categories</a></tab></li>
                        <li><tab><a href="<?= __MAIN_URL__ . "Products/Add"; ?>">Add Products</a></tab></li>
                        <li><tab><a href="<?= __MAIN_URL__ . "Products/Delete"; ?>">Delete Products</a></tab></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        <div id="header-main">
            <div id="logo">
                <a href="<?= __MAIN_URL__ . __HOME_DIRECTORY__ ?>"><img src="<?= __MAIN_URL__ ?>images/logo.jpg" /></a>
            </div>
            <div id="search">
                <form>
                    <input type="text" name="search" class="customInput" placeholder="Enter your search key ... " />
                    <input type="submit" value="Search" class="customButton" />
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div id="main-menu">
            <ul>
                <li><a href="<?= __MAIN_URL__ . __HOME_DIRECTORY__ ?>">HOME</a></li>
                <li><a href="#">LEGAL NOTICE</a></li>
                <li><a href="#">SECURE PAYMENT</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="#">CONTACT US</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>