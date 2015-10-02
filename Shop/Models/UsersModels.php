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

        $checkForValidLoginInfo = 'SELECT username, id, role FROM users WHERE username="'.$username.'"
                                    AND password="'.md5($password).'"';
        $login = $conn->query($checkForValidLoginInfo);
        if($login->rowCount() > 0) {
            $userInfo = $login->fetch();
            $_SESSION['is_logged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userInfo["id"];
            $role = $userInfo["role"];
            if($role == 1) {
                $_SESSION['editor'] = true;
            } else if($role == 2) {
                $_SESSION['admin'] = true;
            }
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

    public function getUserInfo($username) {
        $conn = DB::connect();

        $getUserInfo = 'SELECT username, email, registered_on, cash FROM users WHERE username="'.$username.'"';
        $userInfo = $conn->query($getUserInfo)->fetch();

        return $userInfo;
    }

    public function banUser($username) {
        $db = DB::connect();

        $isUserValidSql = 'SELECT id FROM users WHERE username = "'.$username.'"';
        if($db->query($isUserValidSql)->rowCount() == 0) {
            View::$viewBag['errors'][] = "Invalid username";
        } else {
            $banSql = 'UPDATE users SET isBanned = 1 WHERE username = "'.$username.'"';
            if($db->query($banSql)) {
                View::$viewBag['successMessage'] = "You successfully banned " . $username;
            }
        }
    }

    public function banIp($ip) {
        $db = DB::connect();

        $errors = [];
        if(strlen($ip) < 7) {
            $errors[] = "Invalid ip";
        }

        $ifIpIsBanned = 'SELECT ip FROM banned_ips WHERE ip = "'.$ip.'"';
        if($db->query($ifIpIsBanned)->rowCount() > 0) {
            $errors[] = "The ip is already banned";
        }

        if(count($errors) == 0) {
            $banIpSql = 'INSERT INTO banned_ips(ip) VALUES("'.$ip.'")';
            if($db->query($banIpSql)) {
                View::$viewBag['successMessage'] = "You successfully banned " . $ip;
            }
        } else {
            View::$viewBag['errors'] = $errors;
        }
    }
}