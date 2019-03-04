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
            CacheHelper::create_master_cache();

            PersonnelActionManagement::contractChange();    
            if(date('h:ia') <= date('h:ia', strtotime('1:00am')) || date('h:ia') >= date('h:ia', strtotime('12:00am'))){
            }
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
