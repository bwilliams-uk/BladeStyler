<?php

namespace Williams\BladeStyler\Directives;

use Illuminate\Support\Facades\Blade;

abstract class Directive
{
    abstract protected function name();
    abstract protected function action();

    public function create(){
        Blade::directive(static::name(),static::action());
    }
}
