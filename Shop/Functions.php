<?php

namespace Framework;

class Functions {

    public static function EditorAuthorization() {
        if(!isset($_SESSION['admin']) && !isset($_SESSION['editor'])) {
            throw new \Exception("You don't have acces to this method");
        }
    }
}