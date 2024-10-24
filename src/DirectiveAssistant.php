<?php

namespace Williams\BladeStyler;

use Williams\BladeStyler\Input\ArrayInput;
use Williams\BladeStyler\Input\StringInput;

class DirectiveAssistant
{

    //class styles lookup array, format: ['styleName' => 'class-1 class-2']
    private array $dictionary = [];


    //function called by @bs_set directive

    public function set(array $definitions): void
    {
        $this->dictionary = array_merge($this->dictionary, $definitions);
    }
    

    //function called by @bs_string directive

    public function string(string|array $styles): string
    {
        if (is_array($styles)) {
            $input = new ArrayInput($styles);
        } else {
            $input = new StringInput($styles);
        }
        return $input->toClassString($this->dictionary);
    }

    //function called by @bs_clear

    public function clear($names = null){
        if(is_null($names)){
            //Clear all definitions
            $this->dictionary = [];
            return;
        }
        else{
            //Clear specified definitions
            $names = (!is_array($names)) ? [$names] : $names;
            foreach($names as $name){
                unset($this->dictionary[$name]);
            }
        }
    }
}
