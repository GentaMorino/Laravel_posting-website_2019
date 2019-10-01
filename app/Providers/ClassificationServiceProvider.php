<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//追加
use App\Classification;
use Illuminate\Support\Facades\View;

class ClassificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $classifications=Classification::get();
            $view->with('classifications',$classifications);
        });
    }
}
