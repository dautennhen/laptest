<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
                'App\Repositories\PageRepositoryInterface', 
                'App\Repositories\PageRepository'
        );
        $this->app->bind(
                'App\Repositories\OptionRepositoryInterface', 
                'App\Repositories\OptionRepository'
        );
        $this->app->bind(
                'App\Repositories\CompanyRepositoryInterface', 
                'App\Repositories\CompanyRepository'
        );
        $this->app->bind(
                'App\Repositories\BillingInfoRepositoryInterface', 
                'App\Repositories\BillingInfoRepository'
        );
        $this->app->bind(
                'App\Repositories\NotificationRepositoryInterface', 
                'App\Repositories\NotificationRepository'
        );
        $this->app->bind(
                'App\Repositories\ScheduleRepositoryInterface', 
                'App\Repositories\ScheduleRepository'
        );
    }
}
