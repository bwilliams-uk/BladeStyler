<?php

namespace Williams\BladeStyler\Input;

class ArrayInput extends Input
{

    public function toClassString(array $dictionary): string
    {
        $asString = $this->toStringInput();
        return $asString->toClassString($dictionary);
    }

    private function toStringInput()
    {
        $output = '';
        foreach ($this->input as $key => $value) {
            if (is_int($key)) {
                // Always include $value as class if key is numeric
                $output .= $value . ' ';
            } else {
                // If key is string include only when value is TRUE
                $output .= ($value === true) ? $key . ' ' : '';
            }
        }
        return new StringInput($output);
    }
}
