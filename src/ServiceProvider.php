<?php

namespace Williams\BladeStyler;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Register routes during testing.

        if (App::environment() === 'testing') {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }
        
        // Add directive assistant to views

        View::composer('*', function ($view) {
            $view->with('_bladestyler', new DirectiveAssistant());
        });
        
        // Create Directives
        $directives = include __DIR__ . '\\directives.php';
        foreach ($directives as $directiveClass) {
            $directive = new $directiveClass;
            $directive->create();
        }

    }
}
