<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        View::share('notificationCount', \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count());
    }
}
