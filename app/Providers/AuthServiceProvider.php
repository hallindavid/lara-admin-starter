<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user) {
            return $user->is_admin;
        });


        Gate::define('org-admin', function($user) {
            if ($user->current_org()->exists()) {
                if ($user->current_org->owner->id == $user->id) { return true; }
                // 1000 is org-admin permission in config file
                return ($user->current_org->check_user_permission($user->id, 1000));
            }
            return false;
        });

        Gate::define('manage-users', function($user) {
            if (Gate::allows('org-admin')) {
               return true; 
            }

            if ($user->current_org()->exists()) {
                // 1000 is org-admin permission in config file
                return ($user->current_org->check_user_permission($user->id, 1010));
            }
            return false;
        });
        
    }
}
