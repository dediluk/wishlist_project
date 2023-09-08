<?php

namespace App\Events;


use App\Models\User;
use App\Models\Wish;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSubscriberEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $subscriberUser;
    public User $subscribedUser;
    /**
     * Create a new event instance.
     */
    public function __construct(User $subscriberUser, User $subscribedUser)
    {
        $this->subscriberUser = $subscriberUser;
        $this->subscribedUser = $subscribedUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
