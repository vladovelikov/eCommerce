<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{


    /**
     * Show the admin profile index page.
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Update admin profile properties.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => ['image', 'max:2048'],
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $user->image = '/uploads/' . $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        toastr()->success('Profile updated successfully');

        return redirect()->back();
    }

    /**
     * Update admin profile credentials.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated successfully');

        return redirect()->back();
    }
}
