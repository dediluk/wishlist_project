<?php

namespace App\Listeners;

use App\Events\NewWishAddedEvent;
use App\Notifications\UsersNewWishNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifyWishlistSubscribers implements ShouldQueue
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
    public function handle(NewWishAddedEvent $event): void
    {
        $user = $event->user;
        $wish = $event->wish;
        foreach ($user->subscribers as $subscriber) {
            Notification::send($subscriber, new UsersNewWishNotification($user, $subscriber, $wish));
        }
    }
}
