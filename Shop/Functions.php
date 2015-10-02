<?php

namespace Framework;

class Functions {

    public static function EditorAuthorization() {
        if(!isset($_SESSION['admin']) && !isset($_SESSION['editor'])) {
            throw new \Exception("You don't have acces to this method");
        }
    }

    public static function isIpBanned() {
        $db = DB::connect();

        $isIpBannedSql = 'SELECT ip FROM banned_ips WHERE ip = "'.$_SERVER['REMOTE_ADDR'].'"';
        if($db->query($isIpBannedSql)->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public static function isUserBanned() {
        if(isset($_SESSION['is_logged'])) {
            $db = DB::connect();

            $isUserBannedSql = 'SELECT isBanned FROM users WHERE id = "'.$_SESSION['id'].'"';
            if($db->query($isUserBannedSql)->fetch()["isBanned"] == 1) {
                return true;
            }

            return false;
        } else {
            return false;
        }
    }

    public static function requestMessages($errors, $successMessage) {
        if(isset($errors) && count($errors) > 0): ?>
            <?php foreach($errors as $error): ?>
                <div class="error">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if(isset($successMessage)): ?>
            <div class="success"><?= $successMessage; ?></div>
        <?php endif;
    }
}