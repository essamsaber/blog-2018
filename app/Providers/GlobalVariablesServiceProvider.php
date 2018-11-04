<?php

namespace App\Providers;

use App\Views\Composer\SidebarComposer;
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
        view()->composer('layouts.sidebar', SidebarComposer::class);
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
