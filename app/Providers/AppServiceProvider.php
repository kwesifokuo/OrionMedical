<?php

namespace OrionMedical\Providers;
use OrionMedical\Models\Company;
use OrionMedical\Models\OPD;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $mycompany = Company::get()->first();
        view()->share('mycompany', $mycompany);

        //if(Auth::check()) 
        //{
       // dd(Auth::user()->getRole());
        // if(Auth::user()->getRole() == 'Doctor')
        // {
        $today =        Carbon::now()->format('Y-m-d').'%';
        $notifications = OPD::where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->get();
        view()->share('notifications', $notifications);
        //}
        //}
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
