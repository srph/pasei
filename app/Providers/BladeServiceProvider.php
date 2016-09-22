<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // A directive to set a link as active.
        Blade::directive('active', function($expression) {
            $exploded = explode(',', $expression);
            $route = $exploded[0];
            $class = $exploded[1];

            return "<?php if(\is_route_active($route)): echo ltrim($class, ' '); endif; ?>";
        }); 

        // A DRY directive for selecting an option in `select` elements
        Blade::directive('selected', function($expression) {
            return "<?php if($expression): echo 'selected'; endif; ?>";
        });

        Blade::directive('checked', function($expression) {
            return "<?php if($expression): echo 'checked'; endif; ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
