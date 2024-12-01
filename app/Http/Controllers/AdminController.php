<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\notification;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        $jumlah_seller = Seller::count();
        $jumlah_customer = User::where("role_id", "2")->count();
        $jumlah_kategori = Category::count();
        $jumlah_produk = Product::count();
        $pesanan_selesai = Order::count();
        $pesanan_terbaru = Order::whereBetween(
            "created_at",
            [now()->startOfMonth(), now()->endOfMonth()]
        )
            ->get()
            ->count();
        $pesanan_perbulan = Order::orderBy("created_at")
            ->whereBetween(
                "created_at",
                [now()->subYear()->startOfMonth()->addMonth(), now()->endOfMonth()]
            )
            ->get()
            ->groupBy(function ($d) {
                return Carbon::parse($d->created_at)->format('m');
            });

        $pesanan = [];
        $nama_bulan = [
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Agu",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        ];

        foreach ($pesanan_perbulan as $bulan => $value) {
            $pesanan[$nama_bulan[strval($bulan)]] = $value->count();
        }
        return view("admin.dashboard", compact('jumlah_customer', 'jumlah_produk', 'jumlah_seller', 'jumlah_kategori', 'pesanan_selesai', 'pesanan_terbaru', "pesanan"));
    }

    function laporan()
    {
        $transaksi = Payment::with('payment_status')->whereHas('payment_status', function ($query) {
            $query->where('name', "success");
        })->get();
        $withdrawal = Withdrawal::where('status', 'Disetujui')->get();

        $total_pendapatan = $transaksi->sum('amount');
        $total_keuntungan = $transaksi->sum('aplication_fee');
        $total_approve = $withdrawal->sum('jumlah');

        $pendapatan_perbulan = $transaksi
            ->whereBetween(
                "created_at",
                [now()->subYear()->startOfMonth()->addMonth(), now()->endOfMonth()]
            )
            ->groupBy(function ($d) {
                return Carbon::parse($d->created_at)->format('m');
            });

        $nama_bulan = [
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Agu",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        ];

        $pendapatans = array_fill_keys(array_values($nama_bulan), 0);
        foreach ($pendapatan_perbulan as $bulan => $value) {
            $pendapatans[$nama_bulan[strval($bulan)]] = $value->sum('amount');
        }

        return view('admin.laporan', compact("total_pendapatan", "total_keuntungan", "total_approve", "pendapatans"));
    }

    function notifikasi() {
        $notifications =notification::where("user_id", Auth::user()->id)->get();

        return view('admin.notifikasi', compact("notifications"));
    }
}
