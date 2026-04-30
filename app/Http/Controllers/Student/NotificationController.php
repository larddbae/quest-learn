<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
