<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
use App\Models\Observers\CustomerObserver;
use App\Models\Observers\NotificationObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Notification::observe(NotificationObserver::class);
        Customer::observe(CustomerObserver::class);

        Paginator::useBootstrap();
    }
}
