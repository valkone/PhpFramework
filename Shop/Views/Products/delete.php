<?php
require 'Views/header.php';
//echo '<pre>'.print_r($model['products'], true).'</pre>';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div id="mcontent">
                <?php
                    if(isset($model['error'])) {
                        echo $model['error'];
                    } else if(isset(self::$viewBag["productDeleted"]) && self::$viewBag["productDeleted"]){
                        echo "Product successfully deleted";
                    }
                ?>
                <?php foreach($model['products'] as $product): ?>
                    <?= $product['name']; ?> - <a href="<?= __MAIN_URL__ . "Products/Delete/" . $product['id']; ?>">Delete</a><br />
                <?php endforeach; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>