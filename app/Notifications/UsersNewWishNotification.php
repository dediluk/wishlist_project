<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsersNewWishNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected User $user;
    protected Wish $wish;
    protected User $subscriber;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, User $subscriber, Wish $wish)
    {
        $this->user = $user;
        $this->wish = $wish;
        $this->subscriber = $subscriber;
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
                    ->subject("New wish for {$this->user->name}")
                    ->greeting("Hello, {$this->subscriber->name}!")
                    ->line("User {$this->user->name} added new wish '{$this->wish->title}'")
                    ->action('View new wish', url(route('wishes.show', ['wish'=>$this->wish->id])));
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
