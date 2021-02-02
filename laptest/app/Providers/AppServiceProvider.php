<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Todoitem as Todoitem;
use App\Listeners\UserEventSubscriber;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('cuser', function() {
            return new Todoitem;
        });
        $this->app->bind('subscriber', function() {
            return new UserEventSubscriber;
        });
    }

}
