<?php

namespace App\Services;

use Illuminate\Http\Request;

class NotificationService
{
    public function index(Request $request)
    {
        $readNotifications = auth()->user()->readNotifications;
        $unReadNotifications = auth()->user()->unReadNotifications;
        return compact('readNotifications', 'unReadNotifications');
    }

}
