<?php

namespace Framework;

class Token {

    private static $token;

    public static function generateToken() {
        $token = md5(time(). ' - ' . $_SERVER['SERVER_NAME']);
        self::$token = $token;
        $_SESSION['token'] = $token;
    }

    public static function getToken() {
        return self::$token;
    }

    public static function setToken($token) {
        self::$token = $token;
    }

    public static function tokenValidationCheck() {
        if(isset($_POST['_token'])) {
            if($_SESSION['token'] != $_POST['_token']) {
                throw new \Exception("Invalid token");
            }
        }
    }
}