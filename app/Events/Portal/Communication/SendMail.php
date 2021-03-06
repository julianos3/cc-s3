<?php

namespace CentralCondo\Events\Portal\Communication;

use CentralCondo\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMail extends Event
{
    use SerializesModels;

    public $communicationId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($communicationId)
    {
        $this->communicationId = $communicationId;
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
