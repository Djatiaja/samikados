<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestNotificationController extends Controller
{
    function index(){
        return view("seller.test");
    }

    function store(){
        $admins = User::with('role')->whereHas('role', function($query) {
            $query->where('name', 'admin');
        })->get();

        foreach ($admins as $admin) {
                $notification = new \App\Models\Notification();
                $notification->title = 'New Notification';
                $notification->message = 'This is a test notification';
                $notification->type = 'info';
                $notification->is_read = false;
                $notification->user_id = $admin->id;
                $notification->save();
        }
            
        return redirect('/test-notification');
    }
}
