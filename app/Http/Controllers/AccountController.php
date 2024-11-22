<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use function PHPUnit\Framework\returnSelf;

class AccountController extends Controller 
{

    function index(){
        $users = User::with('role')->get();

        return view("admin.manajemen-akun", compact("users"));
    }

    function suspend($id){
        $user = User::find($id);
        $user->is_suspended = true;
        $user->save();
        return redirect()->route("manajemen-akun")->with("success", "suspend");
    }


    function unsuspend($id)
    {
        $user = User::find($id);
        $user->is_suspended = false;
        $user->save();
        return redirect()->route("manajemen-akun")->with("success", "unsuspend");
    }


    function search(Request $request){
        $search = $request->search;
        $query = User::query();

        $query->whereAny(['username', 'name', 'email'],'LIKE', "%$search%");

        $users = $query->paginate(10);

        return view("admin.manajemen-akun", compact("users"));
    }
}
