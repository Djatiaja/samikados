<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends BaseController
{
    function index(){
        $banners = Banner::paginate(10);

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
        $path = $image->storeAs('banners/', $img_name);
        $data["picture"] = "storage/" . $path;

        Banner::create($data);

        return redirect()->route("manajemen-banner")->with("success", "add_banner");
    }

    function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'picture' => ['nullable', 'image', "mimes:jpeg,png,jpg", 'max:2048']
        ]);

        $banner = Banner::find($id);

        if(isset($data['picture'])){
            if ($banner->icon) {
                try {
                    if (File::exists("/banners/" . $banner->icon)) {
                        File::delete("/banners/" . $banner->icon);
                    }
                } catch (\Throwable $th) {
                    return back()->withError("gagal menyimpan");
                }
            }
            $extension = $request->picture->extension();
            $img_name = date('dmyHis') . '.' . $extension;
            $image = $request->file("picture");
            $path = $image->storeAs('banners/', $img_name);
            $data["picture"] = "storage/" . $path;
        }
        $banner->update($data);
        $banner->save();

        return redirect()->route("manajemen-banner")->with("success", "edit_banner");
    }

    function delete($id)
    {
        $Banner = Banner::where("id", $id);
        $Banner->delete();
        return redirect()->route("manajemen-banner")->with("success", "delete_banner");
    }
}
