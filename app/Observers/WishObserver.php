<?php

namespace App\Observers;

use App\Mail\QuestionApproved;
use App\Models\User;
use App\Models\Wish;
use App\Notifications\WishUpdateNotification;
use Illuminate\Support\Facades\Notification;

class WishObserver
{
    /**
     * Handle the Wish "created" event.
     */
    public function created(Wish $wish): void
    {
        //
    }

    /**
     * Handle the Wish "updated" event.
     */
    public function updated(Wish $wish): void
    {
        //
    }

    /**
     * Handle the Wish "deleted" event.
     */
    public function deleted(Wish $wish): void
    {
        //
    }

    /**
     * Handle the Wish "restored" event.
     */
    public function restored(Wish $wish): void
    {
        //
    }

    /**
     * Handle the Wish "force deleted" event.
     */
    public function forceDeleted(Wish $wish): void
    {
        //
    }
}
