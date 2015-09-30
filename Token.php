<?php

namespace Framework;

class Token {

    private static $token;

    public static function generateToken() {
        $token = md5(time(). ' - ' . $_SERVER['SERVER_NAME']);
        self::$token = $token;
        $_SESSION['token'] = $token;
    }

    public static function isValidToken($token) {
        if($token == self::$token) {
            return true;
        }

        return false;
    }

    public static function getToken() {
        return self::$token;
    }
}