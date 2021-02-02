<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OrderEvent' => [
            'App\Listeners\OrderListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    protected $subscribe = [
        'App\Listeners\UserEventSubscriber',
    ];

    public function boot(DispatcherContract $events) {

        //$events->listen('testmoreevent', function () {
        //    echo 'testmoreevent'; 
        //});
        /*$events->listen('testmoreevent', function($user) {
            var_dump($user);
            echo config('app.timezone');
        });*/
        /* Event::listen('testmorevent', function($user)
          {
          print_r($user);
          }); */
        parent::boot($events);
    }

}
