<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ECommerce Home</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div id="header">
        <div id="top-menu">
            <div id="left-top-menu">
                <tab>Welcome <span>Guest</span></tab>
                <tab>Currency: <span>USD</span></tab>
                <tab>Language: <span>English</span></tab>
            </div>
            <div id="right-top-menu">
                <ul>
                    <li><tab><a href="<?= __MAIN_URL__ . "Users/Login"; ?>">Login</a></tab></li>
                    <li><tab><a href="<?= __MAIN_URL__ . "Users/Register"; ?>">Register</a></tab></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div id="header-main">
            <div id="logo">
                <a href="#"><img src="../images/logo.jpg" /></a>
            </div>
            <div id="search">
                <form>
                    <input type="text" name="search" id="search-input" placeholder="Enter your search key ... " />
                    <input type="submit" value="Search" id="search-button" />
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div id="main-menu">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">LEGAL NOTICE</a></li>
                <li><a href="#">SECURE PAYMENT</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="#">CONTACT US</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>