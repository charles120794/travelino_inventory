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
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       TRAITS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('SystemCommonTrait', function () {
            return \App\Http\Traits\Settings\SystemCommonTrait::class;
        }); 

        $this->app->singleton('SystemCompanyTrait', function () {
            return \App\Http\Traits\Settings\SystemCompanyTrait::class;
        }); 
        
        $this->app->singleton('SystemCompanyModuleAccessTrait', function () {
            return \App\Http\Traits\Settings\SystemCompanyModuleAccessTrait::class;
        });

        $this->app->singleton('SystemMediaUploaderTrait', function () {
            return \App\Http\Traits\Settings\SystemMediaUploaderTrait::class;
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
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       MODELS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('SystemCompany', function () {
            return new \App\Model\Settings\SystemCompany;
        });

        $this->app->singleton('SystemCompanyModule', function () {
            return new \App\Model\Settings\SystemCompanyModule;
        });

        $this->app->singleton('SystemModule', function () {
            return new \App\Model\Settings\SystemModule;
        });

        $this->app->singleton('SystemWindow', function () {
            return new \App\Model\Settings\SystemWindow;
        });

        $this->app->singleton('SystemWindowMethod', function () {
            return new \App\Model\Settings\SystemWindowMethod;
        });

        $this->app->singleton('SystemMediaExtension', function () {
            return new \App\Model\Settings\SystemMediaExtension;
        });

        $this->app->singleton('SystemCompanyPlan', function () {
            return new \App\Model\Settings\SystemCompanyPlan;
        });
    }
}
