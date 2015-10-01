<?php
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                Username: <?= $model["userInfo"]["username"]; ?><br />
                Email: <?= $model["userInfo"]["email"]; ?><br />
                Registered On: <?= date('d-m-Y', $model["userInfo"]["registered_on"]); ?><br />
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>