<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('users.index', ['users' => $this->userService->index()]);
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
        $this->userService->store($request);
        return redirect(route('wishes.index'));
    }

    public function login()
    {
        return view('users.login');
    }

    public function logout(Request $request)
    {
        $this->userService->logout($request);
        return redirect(route(
            'index'
        ));
    }

    public function authenticate(Request $request)
    {
        return $this->userService->authenticate($request) ? redirect(route('index'))
            : back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        return view('users.show', $this->userService->show($id));
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

    public function subscribe(int $subscribed_user_id)
    {
        return $this->userService->subscribe($subscribed_user_id) ? back() : abort(404);
    }

    public function unsubscribe(int $subscribed_user_id)
    {
        return $this->userService->unsubscribe($subscribed_user_id) ? back() : abort(404);
    }

    public function changeRole(int $id, Request $request)
    {
        $this->userService->changeRole($id, $request);
        return back();
    }
}
