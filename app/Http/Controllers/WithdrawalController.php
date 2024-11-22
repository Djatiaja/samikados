<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    function index(){
        $withdrawals = Withdrawal::with(["seller", "Bank"])->get();
        return view("admin.manajemen-withdrawal", compact('withdrawals'));
    }

    function update(Request $request, $id){
        $data = $request->validate([
            'status' => ['required','in:Menunggu,Ditolak,Disetujui']
        ]);
        $withdrawal = Withdrawal::find($id);
        $withdrawal->update($data);
        $withdrawal->save();

        return redirect()->route("manajemen-withdrawal")->with('success', $data['status']);
    }


    function search(Request $request){
        $search = $request->search;
        $query = Withdrawal::with('seller')->whereHas('seller',function($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        });

        $withdrawals = $query->get();
        return view("admin.manajemen-withdrawal", compact('withdrawals'));
    }
}
