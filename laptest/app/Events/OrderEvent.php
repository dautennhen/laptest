<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Todoitem;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderEvent extends Event {

    use SerializesModels;

    public $todoitem;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(Todoitem $item) {
        // When OrderEvent set value,  the OrderListener will have
        // an suitable action
        echo 'abc';
        $this->todoitem = $item;
    }

}
