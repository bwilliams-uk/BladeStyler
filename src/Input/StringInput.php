<?php

namespace Williams\BladeStyler\Input;

class StringInput extends Input
{

    public function toClassString(array $dictionary): string
    {
        $styles = explode(' ', $this->input);
        $output = '';
        foreach ($styles as $style) {
            if (isset($dictionary[$style])) {
                $output .= $dictionary[$style] . ' ';
            } else {
                //allow pass through of undefined class names.
                $output .= $style . ' ';
            }
        }
        return trim($output);
    }
}
