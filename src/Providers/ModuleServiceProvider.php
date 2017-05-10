<?php namespace Xcms\Menu\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Xcms\Menu\Facades\MenuFacade;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Load views*/
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'menu');
        /*Load translations*/
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'menu');
        /*Load migrations*/
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../config' => base_path('config'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../../resources/assets' => resource_path('assets'),
            __DIR__ . '/../../resources/public' => public_path(),
        ], 'assets');
        $this->publishes([
            __DIR__ . '/../../resources/views' => config('view.paths')[0] . '/vendor/menu',
        ], 'views');
        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('resources/lang/vendor/menu'),
        ], 'lang');
        $this->publishes([
            __DIR__ . '/../../database' => base_path('database'),
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //merge config
        $this->mergeConfigFrom(__DIR__ . '/../../config/menu.php', 'menu');

        //Load helpers
        $this->loadHelpers();

        //register menu
        foreach (config('menu') as $key => $value){
            $value['id'] = $key;
            menu()->registerItem($value);
        }

        $this->app->register(RouteServiceProvider::class);

        //Register related facades
        $loader = AliasLoader::getInstance();
        $loader->alias('Menu', MenuFacade::class);
    }

    protected function loadHelpers()
    {
        $helpers = $this->app['files']->glob(__DIR__ . '/../../helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}
