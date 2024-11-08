<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = Product::paginate(10);
        return view('product.index-be', compact('products'));
    }

    function search(Request $request){
        $search = $request->search;
        $query = Product::query();

        $query->whereAny(['sku', 'name', 'description'], 'LIKE', "%$search%");

        $products = $query->paginate(10);

        return view('product.index-be', compact('products'));
    }

    function delete($id){
        $product = Product::find($id);
        $product->delete();
        $product->save();
        return redirect()->route("product.index");
    }

    function restore($id){
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->route("product.trash");
    }

    function trash()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('product.trash-be', compact('products'));
    }
}
