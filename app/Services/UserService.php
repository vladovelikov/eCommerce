<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserService
{

    private const UPLOADS_DIRECTORY_NAME = 'uploads';

    public function updateProfile($request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path(self::UPLOADS_DIRECTORY_NAME), $imageName);

            $user->image = DIRECTORY_SEPARATOR . self::UPLOADS_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
    }

    public function updatePassword($request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);
    }
}
