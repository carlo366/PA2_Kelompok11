<?php

namespace App\Providers;

use App\Events\OrderDelivered;
use App\Listeners\NotifyOrderDelivered;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */


     protected $listen = [
        // ...
        OrderDelivered::class => [
            NotifyOrderDelivered::class,
        ],
    ];
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
    }
}
