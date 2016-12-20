<?php

namespace CentralCondo\Events\Portal\Auth;

use CentralCondo\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMailNewUser extends Event
{
    use SerializesModels;

    public $userCondominiumId;

    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userCondominiumId, $password)
    {
        $this->user_condominium_id = $userCondominiumId;
        $this->password = $password;
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
