<?php

namespace Williams\BladeStyler\Directives;

class MergeDirective extends Directive
{
    protected function name()
    {
        return 'bs_merge';
    }

    protected function action()
    {
        return fn($expression) => '<?php echo $attributes->merge(["class" => $_bladestyler->string(' . $expression . ')]); ?>';
    }
}
