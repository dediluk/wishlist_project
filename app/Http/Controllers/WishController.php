<?php

namespace App\Http\Controllers;

use App\Events\NewWishAddedEvent;
use App\Jobs\DeletedWish;
use App\Models\Category;
use App\Models\User;
use App\Models\Wish;
use http\Client\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class WishController extends Controller
{

    use HandlesAuthorization;

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
        $this->authorize('create', Wish::class);
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
        $wish = Wish::with('usersWhoWish', 'creatorUser', 'reservedBy')->where('id', $id)->withTrashed()->first();
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
//            dispatch(new DeletedWish(auth()->user(), $wish))->delay(now()->addSecond(10));
            Artisan::call('app:test-command');
            return redirect(route('wishes.index'));
        }
        abort(403);
    }
}
