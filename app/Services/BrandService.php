<?php

namespace App\Services;

use App\Models\Brand;
use App\Traits\ImageUploadTrait;

class BrandService
{

    use ImageUploadTrait;

    public function saveBrand(array $brandData)
    {
        $logoPath = $this->uploadImage($brandData['logo'], 'uploads', 'uploads');

        $brand = new Brand();
        $brand->logo = $logoPath;
        $brand->name = $brandData['name'];
        $brand->is_featured = $brandData['is_featured'];
        $brand->status = $brandData['status'];

        $brand->save();
    }

    public function updateBrand(array $brandData, string $id)
    {
        $brand = Brand::findOrFail($id);

        if (isset($brandData['image']) && $brandData['image']) {
            $logoPath = $this->uploadImage($brandData['image'], 'uploads', 'uploads');
        } else {
            $logoPath = null;
        }

        $brand->logo = empty($logoPath) ? $brand->logo : $logoPath;
        $brand->name = $brandData['name'];
        $brand->is_featured = $brandData['is_featured'];
        $brand->status = $brandData['status'];

        $brand->save();
    }

    public function deleteBrand(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->logo);

        $brand->delete();
    }

    public function updateStatus(string $brandId, $brandStatus)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->status = $brandStatus == 'true' ? 1 : 0;

        $brand->save();
    }

}
