<?php

namespace App\Services;

use App\Events\NewWishAddedEvent;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserWishService
{
    public function reserved(string $userId, string $wishId):bool
    {
        $currentUserId = Auth::user()->id;
        User::findOrFail($userId);
        $reservation = DB::table('user_wish')
            ->where([
                ['user_id', '=', $userId],
                ['wish_id', '=', $wishId]
            ])
            ->whereNull('reserved_by')
            ->update(['reserved_by' => $currentUserId]);
        return $reservation;
    }

    public function wished(Request $request)
    {
        $currentUser = Auth::user();
        $wishId = $request->wish_id;

        if ($this->checkWishList($currentUser, $wishId)) {
            return false;
        }

        $wish = Wish::findOrFail($wishId);
        $currentUser->wishedWish()->attach($wishId);
        event(new NewWishAddedEvent(auth()->user(), $wish));
        return true;
    }

    public function unwish(Request $request)
    {
        $currentUser = Auth::user();
        $wishId = $request->wish_id;
        if (!$this->checkWishList($currentUser, $wishId)) {
            return false;
        }
//        $wish = Wish::findOrFail($wishId);
        $currentUser->wishedWish()->detach($wishId);
        return true;
    }

    public function checkWishList(?User $currentUser, int $wishId)
    {
        return isset($currentUser->wishedWish) && $currentUser->wishedWish->contains($wishId);
    }

    public function unreservation(int $userId, int $wishId)
    {
        return DB::table('user_wish')
            ->where([
                ['user_id', '=', $userId],
                ['wish_id', '=', $wishId],
                ['reserved_by', '=', \auth()->id()]
            ])->update([
                'reserved_by' => null
            ]);
    }
}
