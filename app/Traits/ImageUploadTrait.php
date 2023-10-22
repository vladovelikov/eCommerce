<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUploadTrait {

    public function uploadImage(Request $request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $extension = $image->getClientOriginalExtension();
            $imageName = 'media' . '_' . uniqid() . '_' . $extension;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }
}
