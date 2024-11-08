<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $data["icon"] = 'categories/'.$imgname;
    
        Category::create($data);
        
        return redirect()->route("category.index");
    }

    function edit($id){
        $category = Category::find($id);
        return view("category.edit", compact("category"));
    }

    function update(int $id,Request $request){
        $data = $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "icon" => ["nullable", "image", "mimes:jpeg,png,jpg", "max:2048"],
        ]);

        $category = Category::find($id);

        if(isset($data["icon"])){

            if ($category->sampul_buku) {
                try {
                    if (File::exists("/" . $category->icon)) {
                        File::delete("/" . $category->icon);
                    }
                } catch (\Throwable $th) {
                    return back()->withError("gagal menyimpan");
                }
            }

            $extension = $request->icon->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $image = $request->file("icon");
            $path= $image->storeAs('/categories', $imgname, "public");
            $data["icon"]=$path;

        }

        $category->update($data);
        $category->save();

        return redirect()->route("category.index")->with("success", "category berhasil diganti");
    }

    function delete($id){
        $category = Category::find($id);
        $category->delete();

        return redirect()->route("category.index")->with("success", "category berhasil dihapus");
    }
}
