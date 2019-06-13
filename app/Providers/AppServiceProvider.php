<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Helper\Paf\CacheHelper;
use App\Helper\Paf\PersonnelActionManagement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('paf_managements')) {            
            date_default_timezone_set("Asia/Hong_Kong");

            //if(){}
            PersonnelActionManagement::contractChange();    
            PersonnelActionManagement::addSIL();      
            PersonnelActionManagement::updateSIL();      
            PersonnelActionManagement::resetSIL();      
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
