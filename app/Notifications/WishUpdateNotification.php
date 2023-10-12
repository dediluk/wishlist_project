<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WishUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;


    private Wish $wish;
    private User $whoUpdate;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $whoUpdate, Wish $wish)
    {
        $this->whoUpdate = $whoUpdate;
        $this->wish = $wish;
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
            ->subject("{$this->wish->title} was updated")
            ->greeting("Hello, Admin!")
            ->line("{$this->wish->title} (id: {$this->wish->id}) was updated by {$this->whoUpdate->name} ({$this->whoUpdate->email})");
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
