<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Cart;
use View;
use Auth;
use Illuminate\Auth\Access\Response;

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
        //
        Paginator::useBootstrap();


        Gate::define('admin', function($user){
            return $user->role_id === User::ADMIN_ROLE_ID
            ? Response::allow()
            : Response::deny('you must be an administrator');
        });

        view::composer('*',function(){
            if(Auth::check()): //if the user is logged in
                $count = Cart::where('user_id',Auth::user()->id)->where('status','in_cart')->count();

                view::share('count',$count);
            endif;
        });

    }
}
