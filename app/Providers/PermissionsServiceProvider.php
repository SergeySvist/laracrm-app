<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::get()->map(function ($permission){
            Gate::define($permission->slug, function (User $user) use ($permission){
                return $user->hasPermissionComplete($permission);
            });
        });
    }
}
