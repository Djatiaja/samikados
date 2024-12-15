<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use function PHPUnit\Framework\returnSelf;

class AccountController extends BaseController 
{

    function index(){
        $search = request()->search;
        $query = User::with('role');

        if (isset($search)) {
            $query->where(function($q) use ($search) {
            $q->where('username', 'LIKE', "%$search%")
              ->orWhere('name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        if (isset(request()->filter)) {
            $query->whereHas('role', function($q) {
            $q->where('name', request()->filter);
            });
        }

        $users = $query->paginate(10);

        return view("admin.manajemen-akun", compact("users"));
    }

    function suspend($id){
        $user = User::find($id);
        $user->is_suspended = true;
        $user->save();
        return redirect()->back()->with("success", "suspend");
    }


    function unsuspend($id)
    {
        $user = User::find($id);
        $user->is_suspended = false;
        $user->save();
        return redirect()->back()->with("success", "unsuspend");
    }


    function search(Request $request){
        $search = $request->search;
        $query = User::query();

        $query->whereAny(['username', 'name', 'email'],'LIKE', "%$search%");

        $users = $query->paginate(10);

        return view("admin.manajemen-akun", compact("users"));
    }
}
