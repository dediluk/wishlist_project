<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsersNewSubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private User $subscriberUser;
    private User $subscribedUser;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $subscriberUser, User $subscribedUser)
    {
        $this->subscriberUser = $subscriberUser;
        $this->subscribedUser = $subscribedUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("You have a new subscriber")
            ->greeting("Hello, {$this->subscribedUser->name}!")
            ->line("User {$this->subscriberUser->name} subscribed to you!")
            ->action("Subscribe to {$this->subscriberUser->name}", url(route('users.subscribe', ['subscribed_user_id'=>$this->subscriberUser->id])));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
