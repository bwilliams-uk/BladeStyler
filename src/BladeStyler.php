<?php

namespace Williams\BladeStyler;

// Creates a static interface for initialization.
class BladeStyler
{
    public static function initialize($views){
        $initializer = new initializer();
        $initializer->initialize($views);
    }
}
