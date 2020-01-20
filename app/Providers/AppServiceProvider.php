<?php

namespace App\Providers;

//Models
use App\User;
use App\Organization;

//Observers
use App\Observers\UserObserver;
use App\Observers\OrganizationObserver;

use Illuminate\Support\ServiceProvider;

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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
        
        Organization::observe(OrganizationObserver::class);
        User::observe(UserObserver::class);
    }
}
