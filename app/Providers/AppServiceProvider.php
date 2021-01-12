<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //NEW: Increase StringLength
		
		//admin view
        app('view')->composer('admin.layouts.partials.left', function ($view) {
            $action = app('request')->route()->getAction();

            $controller = class_basename($action['controller']);

            list($controller, $action) = explode('@', $controller);

            $view->with(compact('controller', 'action'));
        });
        app('view')->composer('admin.*', function ($view) {
            $view->with('authAdmin', Auth::guard('admin')->user());
        });
        
        //user view 
        app('view')->composer('user.layouts.partials.left', function ($view) {
            $action = app('request')->route()->getAction();

            $controller = class_basename($action['controller']);

            list($controller, $action) = explode('@', $controller);

            $view->with(compact('controller', 'action'));
        });
        app('view')->composer('user.*', function ($view) {
            $view->with('authUser', Auth::guard('web')->user());
        });
        
    }
}
