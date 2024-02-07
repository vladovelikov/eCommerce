<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait {

    public function uploadImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            if ($oldPath && (File::exists(public_path($oldPath)))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $extension = $image->getClientOriginalExtension();
            $imageName = 'media' . '_' . uniqid() . '.' . $extension;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $extension = $image->getClientOriginalExtension();
            $imageName = 'media' . '_' . uniqid() . '.' . $extension;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function deleteImage($imagePath)
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}
