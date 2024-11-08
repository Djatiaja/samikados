<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use function PHPUnit\Framework\returnSelf;

class AccountController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
        
        ];
    }

    function index(){
        $users = User::paginate(10);

        return view("account.index-be", compact("users"));
    }

    function suspend(Request $request){
        
        $data =$request->validate([
            "id"=>"required"
        ]);


        $user = User::find($data["id"]);
        $user->suspend_until = now()->addMonths(1);
        $user->save();

        return redirect()->back();

    }


    function search(Request $request){
        $search = $request->search;
        $query = User::query();

        $query->whereAny(['username', 'name', 'email'],'LIKE', "%$search%");

        $users = $query->paginate(10);

        return view("account.index-be", compact("users"));
    }
}
