<?php

namespace App\Services;

use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;

class ProductImageGalleryService
{

    use ImageUploadTrait;

    public function saveProductImageGallery(array $imageGalleryData)
    {
        $imagesPaths = $this->uploadMultipleImages($imageGalleryData, 'uploads');

        foreach ($imagesPaths as $imagePath) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $imagePath;
            $productImageGallery->product_id = $imageGalleryData['product'];

            $productImageGallery->save();
        }
    }

    public function deleteProductImageGallery(string $imageGalleryId)
    {
        $productImageGallery = ProductImageGallery::findOrFail($imageGalleryId);

        $this->deleteImage($productImageGallery->image);
        $productImageGallery->delete();
    }
}
