<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

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
    public function updateProfile(UpdateUserRequest $request)
    {
        $this->userService->updateProfile($request->validated());

        toastr()->success('Profile updated successfully');

        return redirect()->back();
    }

    /**
     * Update admin profile credentials.
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $this->userService->updatePassword($request->validated(), Auth::user()->id);

        toastr()->success('Password updated successfully');

        return redirect()->back();
    }
}
