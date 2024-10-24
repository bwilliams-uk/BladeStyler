<?php

namespace Williams\BladeStyler\Directives;

class StringDirective extends Directive
{
    protected function name()
    {
        return 'bs_string';
    }

    protected function action()
    {
        return fn($expression) => '<?php echo $_bladestyler->string(' . $expression . '); ?>';
    }
}
