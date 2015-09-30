<?php

namespace Framework\ViewHelpers;

class Textarea
{
    private $attributes = [];
    private $rows = 5;
    private $cols = 20;

    public static function create()
    {
        return new self();
    }

    public function addAttribute($attributeName, $attributeValue) {
        $this->attributes[$attributeName] = $attributeValue;

        return $this;
    }

    public function setRowsAndCols($rows, $cols) {
        $this->rows = $rows;
        $this->cols = $cols;

        return $this;
    }

    public function render() {
        $output = "\n<textarea rows=\"$this->rows\" cols=\"$this->cols\"";
        foreach($this->attributes as $key => $value) {
            $output .= " " . $key . "=" .'"'.$value.'"';
        }
        $output .= "></textarea>";

        echo $output;
    }

}