<?php
namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handle($data) {
        echo 'handle';
        return 'handle';
    }
    
    public function onUserLogin() {
        echo 'onUserLogin';
        return 'onUserLogin';
    }
    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        echo 'onUserLogout';
        return 'onUserLogout';
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }

}