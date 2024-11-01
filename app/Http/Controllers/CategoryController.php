<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    function index(){
        $data = Category::all();
        $jumlah_produk=0;
        return view("category.category", compact("data", "jumlah_produk"));
    }   

    function create(){
        return view("category.create");
    }

    function store(Request $request){
        $data =$request->validate([
            "name"=>["required"],
            "description"=>["required"],
            "icon"=>["required","image", "mimes:jpeg,png,jpg", "max:2048"],
        ]);

        $extension = $request->icon->extension();
        $imgname = date('dmyHis') . '.' . $extension;
        $image = $request->file("icon");
        $image->storeAs('public/categories', $imgname, "public");

        $data["icon"] = 'public/categories/'.$imgname;
    
        Category::create($data);
        
        return redirect()->route("category.index");
    }
}
