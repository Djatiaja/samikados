<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = Product::with('seller')->get();
        $search = request()->search;
        if (isset($search)) {
            $query = Product::query();

            $query->whereAny([ 'name'], 'LIKE', "%$search%")->with('category');

            $products = $query->paginate(10);
        }

        if (isset(request()->category)) {
            $products = $products->filter(function ($product) {
                return $product->category->name === request()->category;
            });
        }

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
            "is_publish" => false
        ]);
        $product->save();
        return redirect()->route("manajemen-produk");
    }
}
