<?php

namespace Framework\Models;

use Framework\DB;
use Framework\View;

class UsersModels {

    public function register($username, $pass, $email) {
        $conn = DB::connect();

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

    public function login($username, $password) {
        $conn = DB::connect();

        $checkForValidLoginInfo = 'SELECT username FROM users WHERE username="'.$username.'" AND password="'.md5($password).'"';
        if($conn->query($checkForValidLoginInfo)->rowCount() > 0) {
            $_SESSION['is_logged'] = true;
            $_SESSION['username'] = $username;
            header("Location: " . __MAIN_URL__ . "Home/home");
            exit;
        } else {
            throw new \Exception("Invalid username or password");
        }
    }

    public function logout() {
        $userModel = new UsersModels();
        $userModel->logout();
    }
}