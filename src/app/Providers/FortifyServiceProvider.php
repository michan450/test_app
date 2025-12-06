<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;


use Laravel\Fortify\Contracts\RegisterResponse;
use App\Actions\Fortify\CustomRegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
    }

    public function boot()
    {
        
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
        Fortify::registerView(function () {
            return view('auth.register');  
        });

        
        Fortify::loginView(function () {
            return view('auth.login');
        });
    }
}
