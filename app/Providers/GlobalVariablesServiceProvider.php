<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class GlobalVariablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view){
            $categories = Category::with(['posts' => function($query){
                return $query->published();
            }])
                ->orderBy('name', 'ASC')
                ->get();
           return $view->with('categories', $categories);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
