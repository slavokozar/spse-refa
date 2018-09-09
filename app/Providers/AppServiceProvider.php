<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $route = app('request')->route();
            if($route != null){
                $action = $route->getAction();

                $controller = class_basename($action['controller']);

                list($_controller, $_action) = explode('@', $controller);

                $view->with(compact('_controller', '_action'));    
            }

            
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
