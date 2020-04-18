<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\User;

class BladeExtrasServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        //
    }

   //tab manage user disembunyikan dari semua role, kecuali admin
    public function boot()
    {
        Blade::if('hasrole', function($expression)
        {
            if(Auth::user())
            {
                //1 tab = hanya bisa di akses oleh 1 role
                // if(Auth::user()->hasAnyRole($expression))
                // {
                //     return true;
                // }

                //1 tab = bisa di akses 2 role atau lebih
                if(Auth::user()->hasAnyRoles($expression))
                {
                    return true;
                }
            }
            return false;
        });
    }
}
