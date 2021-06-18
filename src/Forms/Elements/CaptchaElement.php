<?php

namespace Phlexus\Forms\Elements;

use Phalcon\Forms\Element\AbstractElement;

class CaptchaElement extends AbstractElement
{
    public function render($attributes = null): string
    {
        if(!$attributes) {
            $attributes = $this->getAttributes();
        }

        $attrs = implode(' ', array_map(
            function ($value, $key) { 
                return sprintf("%s='%s'", $key, $value); 
            },
            $attributes,
            array_keys($attributes)
        ));

        $html = '<div ' . $attrs . '></div>';

        return $html;
    }
}