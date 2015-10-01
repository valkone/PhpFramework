<?php

namespace Framework\Models;

use Framework\DB;
use Framework\View;

class UsersModels {

    public function register($username, $pass, $email) {
        $conn = DB::connect();

        $error = null;

        $checkForEmailOrUsernameSql = 'SELECT * FROM users WHERE username = "'.$username.'" OR email = "'.$email.'"';
        if($conn->query($checkForEmailOrUsernameSql)->rowCount() > 0) {
            throw new \Exception("The username or email is already in our database");
        } else {
            $registerSql = 'INSERT INTO users(username, email, registered_on, password)
                        VALUES("'.$username.'", "'.$email.'", "'.time().'", "'.md5($pass).'")';
            if($conn->query($registerSql)) {
                View::$viewBag['registered'] = true;
            } else {
                throw new \Exception("Database error");
            }
        }
    }
}