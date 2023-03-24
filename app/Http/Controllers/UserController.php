<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'confirmed', 'min:6']
            ]
        );

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $newUser = User::create($data);

        auth()->login($newUser);

        return redirect(route('wishes.index'));
    }

    public function login()
    {
        return view('users.login');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route(
            'index'
        ));
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();

            return redirect(route('index'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::with('wishedWish')->find($id);
        $reservedWishes = DB::table('user_wish')
            ->where('reserved_by', $id)
            ->join('users', 'user_wish.user_id', '=', 'users.id')
            ->join('wishes', 'user_wish.wish_id', '=', 'wishes.id')
            ->select('user_wish.user_id', 'user_wish.wish_id', 'users.name', 'wishes.title')
            ->get();
        return view('users.show', compact('user', 'reservedWishes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
