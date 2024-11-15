<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

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
}
