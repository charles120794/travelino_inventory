<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       TRAITS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('UsersAccessAccountTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessAccountTrait::class;
        });

        $this->app->singleton('UsersAccessCompanyTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessCompanyTrait::class;
        });

        $this->app->singleton('UsersAccessInformationTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessInformationTrait::class;
        });
        
        $this->app->singleton('UsersAccessModuleTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessModuleTrait::class;
        });

        $this->app->singleton('UsersAccessWindowMethodTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessWindowMethodTrait::class;
        });

        $this->app->singleton('UsersAccessWindowTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccessWindowTrait::class;
        });

        $this->app->singleton('UsersCollectionModifierTrait', function () {
            return \App\Http\Traits\Accounts\UsersCollectionModifierTrait::class;
        });

        $this->app->singleton('UsersWindowLoaderTrait', function () {
            return \App\Http\Traits\Accounts\UsersWindowLoaderTrait::class;
        });

        $this->app->singleton('UsersMethodLoaderTrait', function () {
            return \App\Http\Traits\Accounts\UsersMethodLoaderTrait::class;
        });

    }

}
