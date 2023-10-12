<?php

namespace App\Services;

use App\Events\MyEvent;
use App\Events\NewSubscriberEvent;
use App\Models\User;
use App\Models\Wish;
use App\Notifications\UsersNewSubscriberNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserService
{

    public function __construct(private Request $request)
    {
    }

    public function index(): Collection
    {
        return $users = User::all();
    }

    public function store(Request $request): void
    {
        $data = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'confirmed', 'min:6']
            ]
        );
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $newUser = User::create($data);
        $newUser->assignRole('user');
        auth()->login($newUser);
    }

    public function logout(Request $request): void
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function authenticate(Request $request): bool
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();
            return true;
        }

        return false;
    }

    public function show(int $id): array
    {
//        Auth::loginUsingId(1);
        $user = User::with('wishedWish')->find($id);
        $reservedWishes = DB::table('user_wish')
            ->where('reserved_by', $id)
            ->join('users', 'user_wish.user_id', '=', 'users.id')
            ->join('wishes', 'user_wish.wish_id', '=', 'wishes.id')
            ->select('user_wish.user_id', 'user_wish.wish_id as id', 'users.name', 'wishes.title')
            ->get();
        $reservationsForUsers = [];
        foreach ($reservedWishes as $item) {
            $reservationsForUsers[$item->name][] = [$item->id, $item->title, $item->user_id];
        }

        $userWishes = DB::table('user_wish')
            ->where('user_wish.user_id', $id)
            ->leftJoin('users', 'user_wish.reserved_by', '=', 'users.id')
            ->join('wishes', 'user_wish.wish_id', '=', 'wishes.id')
            ->select('user_wish.user_id as user_id', 'user_wish.reserved_by as reservedById','user_wish.wish_id as wishId',
                'users.name as reservedByUsername', 'wishes.title as wish_title')
            ->get();
//        dd($userWishes);
        return ['user' => $user, 'reservationsForUsers' => $reservationsForUsers, 'userWishes' => $userWishes];
    }

    public function subscribe(int $subscribedUserId): bool
    {
        $currentUser = auth()->user();
        if ($this->checkAbilityOfSubscription($currentUser, $subscribedUserId)) {
            $currentUser->subscriptions()->attach($subscribedUserId);
            $subscribedUser = User::find($subscribedUserId);
            event(new NewSubscriberEvent($currentUser, $subscribedUser));
            return true;
        }
        return false;
    }

    public function unsubscribe(int $subscribedUserId): bool
    {
        $currentUser = auth()->user();
        if ($this->checkAbilityOfUnsubscription($currentUser, $subscribedUserId)) {
            $currentUser->subscriptions()->detach($subscribedUserId);
            return true;
        }

        return false;
    }

    public function changeRole(int $id, Request $request): void
    {
        $user = User::findOrFail($id);
        dd($request->old('users_role'));
//        $request->flash();
        $new_role = $request->post('users_role');
        $user->removeRole($user->roles[0]->name);
        $user->assignRole($new_role);
    }

    public function checkAbilityOfSubscription(?User $current_user, int $subscribed_user_id): bool
    {
        return $current_user
            && $current_user->id != $subscribed_user_id
            && !$current_user->subscriptions->contains($subscribed_user_id)
            && User::where('id', $subscribed_user_id)->exists();
    }

    public function checkAbilityOfUnsubscription(?User $current_user, int $subscribed_user_id): bool
    {
        return $current_user && $current_user->subscriptions->contains($subscribed_user_id);
    }
}
