<?php

namespace App\Http\Controllers;

use App\Events\NewWishAddedEvent;
use App\Models\Category;
use App\Models\User;
use App\Models\Wish;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishes = Wish::with('categories', 'creatorUser')->get();
        return view('wishes.index', compact('wishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:2'],
            'description' => ['required', 'min:2']
        ]);


        $data['creator'] = auth()->user()->id;

        $newWish = Wish::create($data);
        return redirect(route('wishes.show', ['wish' => $newWish->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $wish = Wish::with('usersWhoWish', 'creatorUser')->where('id', $id)->withTrashed()->first();
        return view('wishes.show', compact('wish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wish $wish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wish $wish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wish $wish)
    {
        if (isset(auth()->user()->roles) && (auth()->user()->hasRole(['admin', 'moderator']) || auth()->user()->id == $wish->creatorUser->id)) {
            $wish->delete();
            DB::table('user_wish')
                ->where('wish_id', $wish->id)
                ->delete();
                return redirect(route('wishes.index'));
        }
        abort(403);

    }
}
