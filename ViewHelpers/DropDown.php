<?php

namespace Framework\ViewHelpers;

class DropDown {
    private $options = '';
    private $attributes = [];

    public static function create() {
        return new self();
    }

    public function setDefaultOption($value) {
        $this->options = "\t<option value=\"\">$value</option>\n" . $this->options;

        return $this;
    }

    public function addAttribute($attributeName, $attributeValue) {
        $this->attributes[$attributeName] = $attributeValue;

        return $this;
    }

    public function setContent($content, $valueKey = 'id', $valueContent = 'value', $keySelected = null, $valueSelected = null) {
        foreach($content as $model) {
            $this->options .= "\t<option";
            if($keySelected && $valueSelected) {
                if($model[$keySelected] == $valueSelected) {
                    $this->options .= " selected ";
                }
            }
            $this->options .= " value=\"{$model[$valueKey]}\">" . $model[$valueContent] . "</option>\n";
        }

        return $this;
    }

    public function render() {
        $output = "<select";
        foreach($this->attributes as $key => $value) {
            $output .= " " . $key . "=" .'"'.$value.'"';
        }
        $output .= ">\n";
        $output .= $this->options;
        $output .= "</select>";

        echo $output;
    }
}