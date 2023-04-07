<?php

namespace App\Http\Controllers;

use App\Events\NewWishAddedEvent;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWishController extends Controller
{
    public function reserve(string $user_id, string $wish_id)
    {
      dd($user_id);
    }

    public function wished(Request $request)
    {
        $currentUser = Auth::user();
        $wish_id = $request->wish_id;

        if (isset($currentUser->wishedWish) && $currentUser->wishedWish->contains($wish_id)) {
            return back()->with('error', 'You already have this wish in your list.');
        }
        $wish = Wish::findOrFail($wish_id);
        $currentUser->wishedWish()->attach($wish_id);
        event(new NewWishAddedEvent(auth()->user(), $wish));
        return redirect(route('users.show', ['user' => $currentUser->id]));
    }
}
