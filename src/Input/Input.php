<?php
namespace Williams\BladeStyler\Input;

use Williams\BladeStyler\StyleDictionary;

abstract class Input{

    protected $input;

    abstract public function toClassString(array $dictionary) : string;

    public function __construct($input){
        $this->input = $input;
    }

}