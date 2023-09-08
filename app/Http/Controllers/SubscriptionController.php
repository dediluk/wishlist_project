<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $subscriber_id = auth()->id();
        $subscriptions = DB::table('user_subscription')
            ->where('user_subscriber_id', $subscriber_id)
            ->join('users', 'user_subscription.user_subscribed_id', '=', 'users.id')
            ->select('users.name', 'users.id')
            ->get();
        return view('subscriptions.index', ['subscriptions' => $subscriptions]);
    }
}
