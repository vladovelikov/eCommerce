<?php

namespace App\Services;

use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;

class VendorProfileService
{

    use ImageUploadTrait;

    public function saveProfile($request)
    {
        $vendor = Vendor::where('user_id', Auth::user()->id)->first();

        $bannerPath = $this->updateImage($request, 'banner', 'uploads', $vendor->banner);

        $vendor->banner = !empty($bannerPath) ? $bannerPath : $vendor->banner;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->tw_link = $request->tw_link;
        $vendor->insta_link = $request->insta_link;

        $vendor->save();
    }
}
