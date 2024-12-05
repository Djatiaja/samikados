<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    function  index()
    {
        $user = User::where("id", Auth::user()->id)->with("role")->first();
        return view('admin.pengaturan-akun', compact('user'));
    }



    /**
     * Update the user's profile information.
     */
    function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . Auth::user()->id],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'. Auth::user()->id ],
        ]);

        $user = User::find(Auth::user()->id);

        $user->update($data);

        // if ($data['email']) {
        //     $user->update([
        //         'email_verified_at' => null
        //     ]);
        // }

        $user->save();
        return Redirect::route('pengaturan-akun')->with('success', 'update_profile');
    }

    function changePassword(Request $request)
    {
        $data = $request->validate([
            "currentPassword" => ["required", "min:8"],
            "password" => ["required", "confirmed", "min:8"]
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($data['currentPassword'], $user->password)) {
            return back()->withErrors(['currentPassword' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return Redirect::route('pengaturan-akun')->with('success', 'update_password');
    }

    function changePhoto(Request $request)
    {
        $data = $request->validate([
            'photo' => ['required', 'image', 'max:2048']
        ]);

        $user = User::find(Auth::user()->id);

        if (!Str::startsWith($user->photo, ['http://', 'https://'])) {
            try {
                if (File::exists("/" . $user->photo)) {
                    File::delete("/" . $user->photo);
                }
            } catch (\Throwable $th) {
                return back()->withError("gagal menyimpan");
            }
        }

        $extension = $request->photo->extension();
        $imgname = date('dmyHis') . '.' . $extension;
        $image = $request->file("photo");
        $path = $image->storeAs('photo', $imgname, "public");
        $data["photo"] = "/storage/" . $path;

        $user->update(
            $data
        );

        $user->save();

        return redirect()->route("pengaturan-akun")->with("success", "update_photo");
    }

    function tambahAdmin(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (!isset($data["username"])){
            $data["username"] = User::generateUsername(null);
        }

        User::create(array_merge($data, ["role_id" => 1, "email_verified_at"=>now()] ));
        return  redirect()->route("pengaturan-akun")->with("success", "add_admin");
    }

}
