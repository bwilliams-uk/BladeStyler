<?php

namespace Williams\BladeStyler\Directives;

class SetDirective extends Directive
{
    protected function name()
    {
        return 'bs_set';
    }

    protected function action()
    {
        return fn($expression) => '<?php echo $_bladestyler->set(' . $expression . '); ?>';
    }
}
