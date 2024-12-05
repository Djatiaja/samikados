<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    function index(){
        $banners = Banner::all();

        return view("admin.manajemen-banner", compact("banners"));
    }

    function store(Request $request){
        $data = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:1000'],
                    'picture' => ['required', 'image', "mimes:jpeg,png,jpg", 'max:2048']
                ]);

        $extension = $request->picture->extension();
        $img_name = date('dmyHis') . '.' . $extension;
        $image = $request->file("picture");
        $path = $image->storeAs('banners/', $img_name, "public");
        $data["picture"] = "storage/" . $path;

        Banner::create($data);

        return redirect()->route("manajemen-banner")->with("success", "add_banner");
    }
}
