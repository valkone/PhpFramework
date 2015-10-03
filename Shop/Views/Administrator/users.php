<?php
$websiteTitle = "Shop :: Products";
require 'Views/header.php';
?>
    <div id="content">
        <?php require 'Views/aside.php'; ?>
        <div id="main-content">
            <div class="product-section">
                <div class="label">Users</div>
                <?php \Framework\Functions::requestMessages(isset(self::$viewBag["errors"]) ? self::$viewBag["errors"] : null,
                    isset(self::$viewBag["successMessage"]) ? self::$viewBag["successMessage"] : null); ?>

                <?php if(isset(self::$viewBag['editing'])): ?>
                    <?php $arrayKey = self::$viewBag['editing']; ?>
                    <form method="post" style="background-color: #3E3E3E; padding: 5px;">
                        <p>Username: </p>
                        <input type="text" class="customInput" name="username" value="<?= $model['users'][$arrayKey]['username'];  ?>" />
                        <p>Email: </p>
                        <input type="text" class="customInput" name="email" value="<?= $model['users'][$arrayKey]['email'];  ?>" />
                        <p>Role: </p>
                        <select name="role">
                            <option value="0" <?php echo $model['users'][$arrayKey]['role'] == 0 ? "selected" : ""; ?>>User</option>
                            <option value="1" <?php echo $model['users'][$arrayKey]['role'] == 1 ? "selected" : ""; ?>>Editor</option>
                            <option value="2" <?php echo $model['users'][$arrayKey]['role'] == 2 ? "selected" : ""; ?>>Administrator</option>
                        </select>
                        <p>Cash: </p>
                        <input type="text" class="customInput" name="cash" value="<?= $model['users'][$arrayKey]['cash'];  ?>" />
                        <input type="hidden" name="userId" value="<?= $model['users'][$arrayKey]["id"]; ?>" /><br /><br />
                        <input type="submit" value="Edit User" name="editUserButton" class="customButton" />
                    </form>
                    <br />
                    <br />
                <?php endif; ?>
                <?php $userCounter = 0; ?>
                <?php foreach($model['users'] as $user): ?>
                    <?= $user['username'] ?> - <a class="customLink" href="<?= __MAIN_URL__ . "Administrator/Users/" . $userCounter++; ?>">Edit</a><br />
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
require 'Views/footer.php';
?>