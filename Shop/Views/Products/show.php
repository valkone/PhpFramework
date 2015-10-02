<?php
$websiteTitle = "Shop :: Product";
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
        <?php if(isset(self::$viewBag["errors"]) && count(self::$viewBag["errors"]) > 0): ?>
            <?php foreach(self::$viewBag["errors"] as $error): ?>
                <div class="error">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if(isset(self::$viewBag["added"])): ?>
            <div class="success">Product successfully added in your cart</div>
        <?php endif; ?>
        <div id="product">

            <div id="product-picture">
                <div id="main-pic">
                    <img src="<?php
                        if(strlen($model['product']['picture']) == 0) {
                            echo __DEFAULT_PICTURE__;
                        } else {
                            echo $model['product']['picture'];
                        }
                    ?>" />
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
                <form method="post">
                    <input type="text" name="quantity" id="quantity-input" value="1"/>
                    <a href="javascript: void(0);" id="add-quantity">+</a>
                    <a href="javascript: void(0);" id="remove-quantity">-</a>
                </div>
                <div id="buy-button-content">
                    <?php if(isset($_SESSION['is_logged'])): ?>
                        <input type="hidden" name="productId" value="<?= $model['product']['ProductId']; ?>" />
                        <input type="hidden" name="productName" value="<?= $model['product']['name']; ?>" />
                        <input type="submit" id="buy-button" name="addToCardButton" value="ADD TO CARD" />
                    <?php endif; ?>
                </form>
                    <?php if(isset($_SESSION['editor']) || isset($_SESSION['admin'])): ?>
                        <a href="<?= __MAIN_URL__ . "Products/Edit/" . $model['product']['ProductId']; ?>" id="buy-button">Edit</a>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['is_logged'])): ?>
                        <a href="javascript: void(0);" onclick="showReviewBox();" id="buy-button">Add Review</a>
                    <?php endif; ?>
                </div>
                <div id="review">
                    <br />
                    Review:
                    <form method="post">
                        <textarea name="review"></textarea>
                        <input type="submit" value="Add review" name="reviewButton" />
                        <input type="hidden" name="productId" value="<?= $model['product']['ProductId']; ?>" />
                    </form>

                </div>
                <br />
                <div class="label">Reviews:</div>
                <?php foreach($model['reviews'] as $review): ?>
                    <div class="review">
                        <div class="review-owner"><?= $review['user']; ?></div>
                        <div class="review-text"><?= $review['review']; ?></div>
                    </div>
                <?php endforeach; ?>
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

    function showReviewBox() {
        $("#review").toggle();
    }
</script>