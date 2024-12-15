<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    function index(){
        $query = Product::with('seller');
        $search = request()->search;
        if (isset($search)) {
            $query->where('name', 'LIKE', "%$search%")->with('category');
        }

        if (isset(request()->category)) {
            $query->whereHas('category', function ($q) {
                $q->where('name', request()->category);
            });
        }

        $products = $query->paginate(10)->appends(request()->query());
        $categories = Category::all();
        return view('admin.manajemen-produk', compact('products', 'categories'));
    }

    function search(Request $request){
        $search = $request->search;
        $query = Product::query();

        $query->whereAny(['name', 'description'], 'LIKE', "%$search%");

        $products = $query->paginate(10);

        return view('admin.manajemen-produk', compact('products'));
    }

    function unpublish($id){
        $product = Product::find($id);
        $product->update([
            "is_publish" => ! $product->is_publish
        ]);
        $product->save();
        return redirect()->back();
    }
}
