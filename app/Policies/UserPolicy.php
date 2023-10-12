<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wish;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function canUnreserveWish(User $user, $wish): bool
    {
        return $user->id == $wish->reservedById;
    }

    public function canViewReservationInfo(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function canReserve(User $currentUser, User $user): bool
    {
        return $user->id != $currentUser->id && $currentUser->id;
    }
}
