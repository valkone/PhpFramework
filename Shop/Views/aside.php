<div id="aside">
    <div class="label">CATEGORY</div>
    <ul>
        <?php
        foreach($model["categories"] as $cat) {
            echo '<a href="#"><li>'.$cat["name"].'</li></a>';
        }
        ?>
    </ul>
</div>