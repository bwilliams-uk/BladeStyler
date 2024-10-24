<?php

namespace Williams\BladeStyler\Directives;

class ClassDirective extends Directive
{
    protected function name()
    {
        return 'bs_class';
    }

    protected function action()
    {
        return  fn($expression) => '<?php echo \'class="\' . $_bladestyler->string(' . $expression . ') . \'"\'; ?>';
    }
}
