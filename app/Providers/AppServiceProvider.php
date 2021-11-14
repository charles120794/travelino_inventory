<?php

namespace App\Providers;

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
        $this->app->singleton('SystemCompanyModuleAccessTrait', function () {
            return \App\Http\Traits\Settings\SystemCompanyModuleAccessTrait::class;
        });

        $this->app->singleton('SystemCompanyTrait', function () {
            return \App\Http\Traits\Settings\SystemCompanyTrait::class;
        });
        
        $this->app->singleton('SystemDatabaseBackupTrait', function () {
            return \App\Http\Traits\Settings\SystemDatabaseBackupTrait::class;
        }); 

        $this->app->singleton('SystemFileSystemTrait', function () {
            return \App\Http\Traits\Settings\SystemFileSystemTrait::class;
        });

        $this->app->singleton('SystemMethodLoaderTrait', function () {
            return \App\Http\Traits\Settings\SystemMethodLoaderTrait::class;
        });

        $this->app->singleton('SystemModuleTrait', function () {
            return \App\Http\Traits\Settings\SystemModuleTrait::class;
        });

        $this->app->singleton('SystemWindowLoaderTrait', function () {
            return \App\Http\Traits\Settings\SystemWindowLoaderTrait::class;
        });

        $this->app->singleton('SystemWindowMethodTrait', function () {
            return \App\Http\Traits\Settings\SystemWindowMethodTrait::class;
        });

        $this->app->singleton('SystemWindowTrait', function () {
            return \App\Http\Traits\Settings\SystemWindowTrait::class;
        });
    }
}
