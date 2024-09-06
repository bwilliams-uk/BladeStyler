<?php

namespace Williams\BladeStyler;

class StyleDictionary{

    //class styles lookup array, format: ['styleName' => 'class-1 class-2']
    private array $dictionary = [];

    //function called by @setStyles directive
    public function setStyles(array $definitions): void
    {
        $this->dictionary = array_merge($this->dictionary, $definitions);
    }

    //function called by @styles directive
    public function stylesToString(string|array $styles): string
    {
        if (is_array($styles)) {
            $styles = $this->convertStylesArrayToString($styles);
        }
        return $this->replaceDictionaryItems($styles);
    }

    //function called by @applyStyles directive
    public function stylesToClassAttribute($styles)
    {
        return 'class="' . $this->stylesToString($styles) . '"';
    }

    //Evaluate arrays similar to built in laravel @class directive
    private function convertStylesArrayToString(array $styles): string
    {
        $output = '';
        foreach ($styles as $key => $value) {
            if (is_int($key)) {
                // Always include $value as class if key is numeric
                $output .= $value . ' ';
            } else {
                // If key is string include only when value is TRUE
                $output .= ($value === true) ? $key . ' ' : '';
            }
        }
        return $output;
    }

    // Returns $string with dictionary keys replaced with their values.
    private function replaceDictionaryItems(string $string){
        $styles = explode(' ', $string);
        $output = '';
        foreach ($styles as $style) {
            if (isset($this->dictionary[$style])) {
                $output .= $this->dictionary[$style] . ' ';
            } else {
                //allow pass through of undefined class names.
                $output .= $style . ' ';
            }
        }
        return trim($output);
    }

    // Make the the StyleDictionary Object Invokable.
    // E.g. can use $_style('style names') to call stylesToString method
    public function __invoke(): mixed
    {
        if (func_num_args() == 1 && is_string(func_get_arg(0))) {
            return $this->stylesToString(func_get_arg(0));
        }
    }
}