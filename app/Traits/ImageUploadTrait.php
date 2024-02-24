<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait {

    public function uploadImage($image, $path, $oldPath = null)
    {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $extension = $image->getClientOriginalExtension();
            $imageName = 'media' . '_' . uniqid() . '.' . $extension;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
    }

//    public function updateImage($image, $path, $oldPath = null)
//    {
//            if (File::exists(public_path($oldPath))) {
//                File::delete(public_path($oldPath));
//            }
//
//            $extension = $image->getClientOriginalExtension();
//            $imageName = 'media' . '_' . uniqid() . '.' . $extension;
//
//            $image->move(public_path($path), $imageName);
//
//            return $path . '/' . $imageName;
//
//    }

    public function uploadMultipleImages($imageGalleryData, $path)
    {
        $imagesPaths = [];

        if (isset($imageGalleryData['images']) && $imageGalleryData['images']) {

            foreach ($imageGalleryData['images'] as $image) {
                $extension = $image->getClientOriginalExtension();
                $imageName = 'media' . '_' . uniqid() . '.' . $extension;

                $image->move(public_path($path), $imageName);

                $imagesPaths[] = $path . '/' . $imageName;
            }

            return $imagesPaths;
        }
    }

    public function deleteImage($imagePath)
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}
