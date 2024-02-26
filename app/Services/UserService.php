<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserService
{

    private const UPLOADS_DIRECTORY_NAME = 'uploads';

    public function updateProfile(array $userData)
    {
        $user = Auth::user();

        if (isset($userData['image']) && $userData['image']) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = $userData['image'];
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path(self::UPLOADS_DIRECTORY_NAME), $imageName);

            $user->image = DIRECTORY_SEPARATOR . self::UPLOADS_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $imageName;
        }

        $user->name = $userData['name'];
        $user->email = $userData['email'];

        $user->save();
    }

    public function updatePassword(array $passwordData, $userId)
    {
        $user = User::findOrFail($userId);
        $user->password = bcrypt($passwordData['password']);
        $user->save();
    }
}
