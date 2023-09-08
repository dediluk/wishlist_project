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

class NewWishAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Wish $wish;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Wish $wish)
    {
        $this->user = $user;
        $this->wish = $wish;
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
