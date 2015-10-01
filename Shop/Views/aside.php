<div id="aside">
    <div class="label">CATEGORY</div>
    <ul>
        <?php
        foreach($model["categories"] as $cat) {
            echo '<a href="'. __MAIN_URL__.'Categories/Product/'.$cat["id"].'"><li>'.$cat["name"].'</li></a>';
        }
        ?>
    </ul>
</div>