<?php

namespace Framework\ViewHelpers;

class AjaxViewHelper
{
    private $ajax;

    public static function create()
    {
        return new self();
    }

    public function init($selector, $event = 'click', $action, $method = 'POST', array $data = array(), $callbackBody = null)
    {
        $ajax = "$(\"$selector\").$event(function(e) {\n";
        $ajax .= "$.ajax({\n";
        $ajax .= "url: $action \n";
        $ajax .= "method: \"$method\" \n";
        $ajax .= "data: {\n";

        foreach ($data as $k => $v) {
            $ajax .= "$k: \"$v\",\n";
        }

        $ajax .= "}})\n";

        if($callbackBody) {
            $ajax .= ".done(
                $callbackBody
            );";
        }

        $this->ajax = $ajax;

        return $this;
    }

    public function render()
    {
        echo $this->ajax;
    }
}