<?php

namespace App\Providers;

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
        Blade::directive('active', function($expression) {
            $exploded = explode(',', $expression);
            $route = $exploded[0];
            $class = $exploded[1];

            return "<?php if(\is_route_active($route)): echo ltrim($class, ' '); endif; ?>";
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
