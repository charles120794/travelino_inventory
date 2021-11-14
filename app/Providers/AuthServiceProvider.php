<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;  

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

        Passport::routes();

        Passport::enableImplicitGrant();

        /**
         * Module Policy
         */
        Gate::define('module-not-exists', 'App\Policies\SystemModuleAccessPolicy@moduleNotExists');

        Gate::define('user-access-module', 'App\Policies\SystemModuleAccessPolicy@userAccessModule');

        /**
         * Window Policy
         */
        Gate::define('window-not-exists', 'App\Policies\SystemWindowAccessPolicy@windowNotExists');

        Gate::define('user-access-window', 'App\Policies\SystemWindowAccessPolicy@userAccessWindow');

        /**
         * Method Policy
         */
        Gate::define('window-method-not-exists', 'App\Policies\SystemWindowAccessMethodPolicy@windowMethodNotExists');

        Gate::define('user-access-window-method', 'App\Policies\SystemWindowAccessMethodPolicy@userAccessWindowMethod');
    }
}
