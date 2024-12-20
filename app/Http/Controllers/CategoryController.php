<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends BaseController
{
    function index(){
        $search = request()->search;

        if (isset($search)) {
            $categories = Category::with('product')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->paginate(10);
        } else {
            $categories = Category::withCount("product")->paginate(10);
        }

        return view("admin.manajemen-kategori", compact("categories"));
    }  
    function store(Request $request){
        $data =$request->validate([
            "name"=>["required"],
            "description"=>["required"],
            "icon"=>["required","image", "mimes:jpeg,png,jpg", "max:2048"],
            "banner" => ["nullable", "image", "mimes:jpeg,png,jpg", "max:2048"],
        ]);

        $extension = $request->icon->extension();
        $img_name = date('dmyHis') . '.' . $extension;
        $image = $request->file("icon");
        $path = $image->storeAs('categories/icon', $img_name);
        $data["icon"] = "storage/" . $path;

        if(isset($data["banner"])){
            $extension = $request->icon->extension();
            $img_name = date('dmyHis') . '.' . $extension;
            $image = $request->file("banner");
            $path = $image->storeAs('categories/banner', $img_name);
            $data["banner"] = "storage/" . $path;
        }
    
        Category::create($data);
        
        return redirect()->route("manajemen-kategori")->with("add-success", "category berhasil ditambah");
    }

    function update(int $id,Request $request){
        $data = $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "icon" => ["nullable", "image", "mimes:jpeg,png,jpg", "max:2048"],
            "banner" => ["nullable", "image", "mimes:jpeg,png,jpg", "max:2048"],
        ]);
        $category = Category::find($id);

        if(isset($data["icon"])){
            if ($category->icon) {
                try {
                    if (File::exists("/" . $category->icon)) {
                        File::delete("/" . $category->icon);
                    }
                } catch (\Throwable $th) {
                    return back()->withError("gagal menyimpan");
                }
            }

            $extension = $request->icon->extension();
            $img_name = date('dmyHis') . '.' . $extension;
            $image = $request->file("icon");
            $path= $image->storeAs('categories/icon', $img_name);
            $data["icon"]= "storage/".$path;


    
        }
        if (isset($data["banner"])) {
            if ($category->banner) {
                try {
                    if (File::exists("/" . $category->banner)) {
                        File::delete("/" . $category->banner);
                    }
                } catch (\Throwable $th) {
                    return back()->withError("gagal menyimpan");
                }
            }

            $extension = $request->icon->extension();
            $img_name = date('dmyHis') . '.' . $extension;
            $image = $request->file("banner");
            $path = $image->storeAs('categories/banner', $img_name);
            $data["banner"] = "storage/" . $path;
        }

        $category->update($data);
        $category->save();

        return redirect()->back()->with("update-success", "category berhasil diganti");
    }

    function delete($id){
        $category = Category::where("id", $id)->withCount("product")->first();
        if($category->product_count < 0){
            return redirect()->route("manajemen-kategori")->with("error", "category gagal dihapus");
        }
        $category->delete();
        return redirect()->back()->with("delete-success", "category berhasil dihapus");
    }
}
