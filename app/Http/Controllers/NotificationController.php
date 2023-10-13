<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct(private NotificationService $notificationService)
    {
    }

    public function index(Request $request)
    {
        $notifications = $this->notificationService->index($request);
        return view('notifications.index', compact('notifications'));
    }
}
