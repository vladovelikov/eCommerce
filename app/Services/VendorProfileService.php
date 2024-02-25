<?php

namespace App\Services;

use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;

class VendorProfileService
{

    use ImageUploadTrait;

    public function saveProfile(array $vendorData, string $vendorId)
    {
        $vendor = Vendor::where('user_id', $vendorId)->first();

        if (isset($vendorData['banner']) && $vendorData['banner']) {
            $vendorData['banner'] = $this->uploadImage($vendorData['banner'], 'uploads');
        } else {
            unset($vendorData['banner']);
        }

        $vendor->fill($vendorData);
        $vendor->save();
    }
}
