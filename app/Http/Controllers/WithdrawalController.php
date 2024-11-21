<?php

namespace App\Http\Controllers;

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
}
