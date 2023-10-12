<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Wish;
use App\Notifications\WishUpdateNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class DeletedWish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $user, protected Wish $wish)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                Notification::send($admin, new WishUpdateNotification($this->user, $this->wish));
            }
        } catch (\Exception $exception) {
            \Log::error(__METHOD__);
            \Log::error($exception);
        }
    }
}
