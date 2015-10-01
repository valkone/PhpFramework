<?php
require 'Views/header.php';
?>
<div id="content">
    <div id="aside">
        <div class="label">Tags</div>
        <div id="tags">
            <a href="#">Women</a>
            <a href="#">Fashion</a>
            <a href="#">Fashion</a>
            <a href="#">Kids</a>
            <a href="#">Kids</a>
            <a href="#">Kids</a>
            <a href="#">New</a>
        </div>
    </div>
    <div id="main-content">
        <div id="product">
            <div id="product-picture">
                <div id="main-pic">
                    <img src="images/product.jpg" />
                </div>
                <!--<div id="small-pics">
                    <div class="small-pic">
                        <img src="images/product.jpg" />
                    </div>
                    <div class="small-pic">
                        <img src="images/product.jpg" />
                    </div>
                    <div class="small-pic">
                        <img src="images/product.jpg" />
                    </div>
                </div>-->
            </div>
            <div id="product-description">
                <h1><?= $model['product']['name']; ?></h1>
                <b>Condition:</b>  <span><?php echo $model['product']['condition'] == 1 ? "New" : "Second Hand"; ?></span>
                <br />
                <br />
                <div class="hr"></div>
                <div class="product-price" style="padding: 13px 0;font-size: 23px;">
                    $<?= $model['product']['price']; ?>
                </div>
                <div class="hr"></div>
                <br />
                <div class="label">Description:</div>
                <div id="description"><?= $model['product']['description']; ?></div>
                <div id="available">
                    <?= $model['product']['quantity']; ?> items <span>In stock</span>
                </div>
                <div id="quantity">
                    Quantity
                    <input type="text" id="quantity-input" value="1"/>
                    <a href="javascript: void(0);" id="add-quantity">+</a>
                    <a href="javascript: void(0);" id="remove-quantity">-</a>
                </div>
                <div id="buy-button-content">
                    <button id="buy-button">ADD TO CARD</button>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php
require 'Views/footer.php';
?>
<script type="text/javascript">
    $("#add-quantity").click(function(){
        var currentQuantity = $("#quantity-input").val();
        var newQuantity = parseFloat(currentQuantity) + 1;
        if(newQuantity <= <?= $model['product']['quantity']; ?>) {
            $("#quantity-input").val(newQuantity);
        }
    });

    $("#remove-quantity").click(function(){
        var currentQuantity = $("#quantity-input").val();
        var newQuantity = parseFloat(currentQuantity) - 1;
        if(newQuantity >= 0) {
            $("#quantity-input").val(newQuantity);
        }
    });
</script>