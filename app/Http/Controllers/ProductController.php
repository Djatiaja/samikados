<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = Product::with('seller')->get();
        return view('admin.manajemen-produk', compact('products'));
    }

    function search(Request $request){
        $search = $request->search;
        $query = Product::query();

        $query->whereAny(['sku', 'name', 'description'], 'LIKE', "%$search%");

        $products = $query->paginate(10);

        return view('admin.manajemen-produk', compact('products'));
    }

    function unpublish($id){
        $product = Product::find($id);
        $product->update([
            "is_publish" => false
        ]);
        $product->save();
        return redirect()->route("manajemen-produk");
    }
}
