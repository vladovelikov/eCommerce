<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;

class ProductService
{

    use ImageUploadTrait;

    public function saveProduct(array $productData)
    {
        if (isset($productData['image']) && $productData['image']) {
            $productData['image'] = $this->uploadImage($productData['image'], 'uploads');
        } else {
            unset($productData['image']);
        }

        $product = new Product();

        //TODO: set the vendor_id for the product
        $productData['vendor_id'] = Auth::user()->vendor->id;
        $product->fill($productData);

        $product->save();
    }

    public function updateProduct($productData, $id)
    {
        $product = Product::findOrFail($id);

        if (isset($productData['image']) && $productData['image']) {
            $productData['image'] = $this->uploadImage($productData['image'], 'uploads', $product->image);
        } else {
            unset($productData['image']);
        }

        $product->fill($productData);

        $product->save();
    }

    public function deleteProduct(string $id, string $vendorId = null)
    {
        $query = Product::where('id', $id);

        if ($vendorId) {
            $query->where('vendor_id', $vendorId);
        }

        $product = $query->firstOrFail();

        $productImages = ProductImageGallery::where('product_id', $product->id)->get();

        //Delete the main product image
        $this->deleteImage($product->image);

        //Delete the product gallery images
        foreach ($productImages as $productImage) {
            $this->deleteImage($productImage->image);
            $productImage->delete();
        }

        //Delete product variants if exist
        $productVariants = ProductVariant::where('product_id', $product->id)->get();

        foreach ($productVariants as $productVariant) {
            $productVariant->productVariantItems()->delete();
            $productVariant->delete();
        }

        $product->delete();
    }

    public function updateStatus(string $productId, $status)
    {
        $product = Product::findOrFail($productId);
        $product->status = $status == 'true' ? 1 : 0;
        $product->save();
    }
}
