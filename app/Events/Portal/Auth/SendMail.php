<?php

namespace CentralCondo\Events\Portal\Auth;

use CentralCondo\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMail extends Event
{
    use SerializesModels;

    public $userCondominiumId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userCondominiumId)
    {
        $this->user_condominium_id = $userCondominiumId;
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
