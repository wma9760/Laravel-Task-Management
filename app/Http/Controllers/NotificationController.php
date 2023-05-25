<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function sendNotification($title,$body)
    {
        $user = Auth::user();

        // Create a new notification instance and set its properties
        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->title = $title;
        $notification->body = $body;
        // Save the notification to the database
        $notification->save();
    }
}
