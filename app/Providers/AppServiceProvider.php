<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot(GateContract $gate)
    {
        Schema::defaultStringLength(191);
        //Check for Admin
        //Return true if auth user type is admin
        $gate->define('isAdmin',function($user){
            return $user->type == 'admin';
        });
        //Check for Author
        //Return true if auth user type is author
        $gate->define('isAuthor',function($user){
            return $user->type == 'author';
        });
        //Check for Editor
        //Return true if auth user type is editor
        $gate->define('isStudent',function($user){
            return $user->type == 'student';
        });
    }
}
