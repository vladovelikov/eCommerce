<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }


    /**
     * Display the user's profile dashboard.
     */
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    /**
     * Update the user's properties.
     */
    public function updateProfile(UpdateUserRequest $request)
    {
        $this->userService->updateProfile($request->validated());

        toastr()->success('Profile updated successfully.');

        return redirect()->back();
    }


    /**
     * Update the user's password.
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $this->userService->updatePassword($request->validated(), Auth::user()->id);

        toastr()->success('Password changed successfully.');

        return redirect()->back();
    }
}
