<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile()
    {
        return view("/profile",
            ["countries" => Country::select("id", "country_name")->get()]);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nickname' => 'required', 'string', 'min:4', 'max:20', 'unique:users',
            'avatar' => 'mimes:png,jpg,jpeg|max:2048', //falta
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'name' => 'regex:/^[a-zA-Z]+$/u', 'max:50',
            'surname' => 'regex:/^[a-zA-Z]+$/u', 'max:50',
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('assets/avatars'), $filename);
            $user->avatar = $filename;
        }
        $user->update([
            'nickname' => $request->nickname,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'country_id' => $request->profileCountry,
        ]);
        return redirect("profile");
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
