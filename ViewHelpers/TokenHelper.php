<?php

namespace Framework\ViewHelpers;

class TokenHelper {

    public static function create() {
        return new self();
    }

    public function generateHiddenField() {
        $token = \Framework\Token::getToken();
        $field = "<input type=\"hidden\" name=\"_token\" value=\"$token\" />";

        echo $field;
    }
}