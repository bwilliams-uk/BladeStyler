<?php

namespace Williams\BladeStyler;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class Initializer
{
    //Name of the variable shared with views that contains reference to a StyleDictionary object.
    // Default is '_style',  making the object accessible in views from the variable '$_style'.
    private string $styleDictionaryVariable = '_style';

    public  function initialize(string|array $views): void
    {
        $this->createViewComposer($views);
        $this->createSetStylesDirective();
        $this->createStylesDirective();
        $this->createApplyStylesDirective();
    }

    //Create view composer to add BladeStyler instance to specified views
    private function createViewComposer($views)
    {
        View::composer($views, function ($view) {
            $view->with($this->styleDictionaryVariable, new StyleDictionary());
        });
    }

    private function createSetStylesDirective()
    {
        $fn = $this->createDirectiveFunctionForMethod('setStyles'); //See StyleDictionary::setStyles
        Blade::directive('setStyles',$fn);
    }

    private function createStylesDirective()
    {
        $fn = $this->createDirectiveFunctionForMethod('stylesToString'); //See StyleDictionary::stylesToString
        Blade::directive('styles',$fn);
    }

    private function createApplyStylesDirective(){
        $fn = $this->createDirectiveFunctionForMethod('stylesToClassAttribute'); //See StyleDictionary::stylesToClassAttribute
        Blade::directive('applyStyles', $fn);
    }

    /* Returns a function that can be used to create a blade directive. The function in effect "forwards" the directive to a 
    specified method of the StyleDictionary and prints the result.
     */
    private function createDirectiveFunctionForMethod($method){
        return fn($expression)=> '<?php echo $' . $this->styleDictionaryVariable . '->' . $method . '(' . $expression . '); ?>';
    }
}
