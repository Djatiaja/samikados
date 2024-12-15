<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends BaseController
{
    function index(){
        $query = Withdrawal::with(["seller", "Bank"]);

        $search = request()->search;

        if (isset($search)) {
            $query = $query->whereHas('seller', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if (isset(request()->filter)) {
            $query = $query->where('status', request()->filter);
        }

        if (isset(request()->sort)){
            if (request()->sort === 'desc') {
                $query = $query->orderBy('created_at', 'desc');
            } else {
                $query = $query->orderBy('created_at', 'asc');
            }
        }

        $withdrawals = $query->paginate(10);

        return view("admin.manajemen-withdrawal", compact('withdrawals'));
    }

    function update(Request $request, $id){
        $data = $request->validate([
            'status' => ['required','in:Ditolak,Disetujui']
        ]);
        $withdrawal = Withdrawal::find($id);
        if($withdrawal->status !== "Menunggu"){
            return redirect()->back()->with("failed", "status");
        }
        $withdrawal->update($data);
        $withdrawal->save();

        return redirect()->back()->with('success', $data['status']);
    }


    function search(Request $request){
        $search = $request->search;
        $query = Withdrawal::with('seller')->whereHas('seller',function($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        });

        $withdrawals = $query->paginate(10);
        return view("admin.manajemen-withdrawal", compact('withdrawals'));
    }
}
