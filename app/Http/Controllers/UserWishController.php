<?php

namespace App\Http\Controllers;

use App\Events\NewWishAddedEvent;
use App\Models\Wish;
use App\Services\UserWishService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWishController extends Controller
{

    public function __construct(private UserWishService $userWishService)
    {
    }

    public function reserved(string $user_id, string $wish_id)
    {
        return $this->userWishService->reserved($user_id, $wish_id) ? back() : abort(403);
    }

    public function unreservation(int $userId, int $wishId)
    {
        return $this->userWishService->unreservation($userId, $wishId) ? back() : abort(403);
    }
    public function wished(Request $request)
    {
        return $this->userWishService->wished($request) ?
            back()
            :
            back()->with('error', 'You already have this wish in your list.');
    }

    public function unwish(Request $request)
    {
        return $this->userWishService->unwish($request) ?
            back()
            :
            abort(403);
    }
}
