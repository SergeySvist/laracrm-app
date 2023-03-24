<?php

namespace App\Providers;

use App\Services\Files\FileService;
use App\Services\Zip\ZipService;
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
        $this->app->singleton(FileService::class, function (){
            return new FileService();
        });
        $this->app->singleton(ZipService::class, function (){
            return new ZipService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
