<?php

namespace Williams\BladeStyler\Directives;

class ClearDirective extends Directive
{
    protected function name()
    {
        return 'bs_clear';
    }

    protected function action()
    {
        return fn($expression) => '<?php echo $_bladestyler->clear(' . $expression . '); ?>';
    }
}
