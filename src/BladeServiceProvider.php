<?php

namespace Prexlab\LaravelMixmix;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-mixmix');
        Blade::directive('mixmix', function ($expression) {
            return '<?php $__env->startComponent(\'laravel-mixmix::mixmix\'); ?>';
        });

        Blade::directive('endmixmix', function ($expression) {
            return '<?php echo $__env->renderComponent(); ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
