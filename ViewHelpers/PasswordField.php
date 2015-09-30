<?php

namespace Framework\ViewHelpers;

class PasswordField
{
    private $attributes = [];

    public static function create()
    {
        return new self();
    }

    public function addAttribute($attributeName, $attributeValue) {
        $this->attributes[$attributeName] = $attributeValue;

        return $this;
    }

    public function render() {
        $output = "\n<input type=\"password\"";
        foreach($this->attributes as $key => $value) {
            $output .= " " . $key . "=" .'"'.$value.'"';
        }
        $output .= " />";

        echo $output;
    }

}