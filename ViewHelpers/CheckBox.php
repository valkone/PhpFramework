<?php

namespace Framework\ViewHelpers;

class CheckBox
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
        $output = "\n<input type=\"checkbox\"";
        foreach($this->attributes as $key => $value) {
            $output .= " " . $key . "=" .'"'.$value.'"';
        }
        $output .= " />";

        echo $output;
    }

}