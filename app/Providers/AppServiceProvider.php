<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('elevate', function(User $user) : bool {
        //     if($user->roles->first()->name==='Admin'){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // });

        // Gate::define('create', function(User $user) : bool {
        //     if($user->roles->first()->name==='Manager'){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // });
    }
}
