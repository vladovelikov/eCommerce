<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class VendorProfileController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        return view('vendor.dashboard.profile');
    }

    /**
     * Update the vendor's properties.
     */
    public function updateProfile(UpdateUserRequest $request)
    {
        $this->userService->updateProfile($request);

        toastr()->success('Profile updated successfully.');

        return redirect()->back();
    }


    /**
     * Update the vendor's password.
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $this->userService->updatePassword($request);

        toastr()->success('Password changed successfully.');

        return redirect()->back();
    }
}
