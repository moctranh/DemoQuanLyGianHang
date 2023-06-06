<?php

namespace Modules\Manager\Events;

use Illuminate\Queue\SerializesModels;


class ConfirmOrderEvent
{
    use SerializesModels;

    public $order_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
