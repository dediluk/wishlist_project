<?php

namespace App\Listeners;

use App\Events\NewSubscriberEvent;
use App\Notifications\UsersNewSubscriberNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;

class NotifyNewSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewSubscriberEvent $event): void
    {
        $subscriberUser = $event->subscriberUser;
        $subscribedUser = $event->subscribedUser;
        Notification::send($subscribedUser, new UsersNewSubscriberNotification($subscriberUser, $subscribedUser));
    }
}
