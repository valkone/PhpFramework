<?php
$websiteTitle = "Shop :: Profile";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                Username: <b><?= $model["userInfo"]["username"]; ?></b><br />
                Email: <b><?= $model["userInfo"]["email"]; ?></b><br />
                Registered On: <b><?= date('d-m-Y', $model["userInfo"]["registered_on"]); ?></b><br />
                Cash: <b>$<?= $model['userInfo']['cash']; ?></b>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>