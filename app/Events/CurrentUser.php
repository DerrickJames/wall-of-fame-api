<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CurrentUser extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Current user token.
     *
     * @var string
     **/
    public $token;

    /**
     * Current user object.
     *
     * @var array
     **/
    public $currentUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($token, $currentUser)
    {
        $this->token = $token;
        $this->currentUser = $currentUser;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['current-user'];
    }
}
