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
        $imagePath = $this->uploadImage($productData['image'], 'uploads');

        $product = new Product();
        $product->image = $imagePath;
        $product->name = $productData['name'];

        //TODO: set the vendor_id for the product
        $product->vendor_id = Auth::user()->id;
        $product->category_id = $productData['category'];
        $product->subcategory_id = $productData['subcategory'];
        $product->child_category_id = $productData['child_category'];
        $product->brand_id = $productData['brand'];
        $product->quantity = $productData['qty'];
        $product->short_description = $productData['short_description'];
        $product->long_description = $productData['long_description'];
        $product->video_url = $productData['video_url'];
        $product->sku = $productData['sku'];
        $product->price = $productData['price'];
        $product->offer_price = $productData['offer_price'];
        $product->offer_start_date = $productData['offer_start_date'];
        $product->offer_end_date = $productData['offer_end_date'];
        $product->product_type = $productData['product_type'];
        $product->status = $productData['status'];
        $product->is_approved = 1;
        $product->seo_title = $productData['seo_title'];
        $product->seo_description = $productData['seo_description'];

        $product->save();
    }

    public function updateProduct($productData, $id)
    {
        $product = Product::findOrFail($id);

        if (isset($productData['image']) && $productData['image']) {
            $imagePath = $this->uploadImage($productData['image'], 'uploads', $product->image);
        } else {
            $imagePath = null;
        }

        $product->image = empty(!$imagePath) ? $imagePath : $product->image;
        $product->name = $productData['name'];

        //TODO: set the vendor_id for the product
        $product->vendor_id = Auth::user()->id;
        $product->category_id = $productData['category'];
        $product->subcategory_id = $productData['subcategory'];
        $product->child_category_id = $productData['child_category'];
        $product->brand_id = $productData['brand'];
        $product->quantity = $productData['qty'];
        $product->short_description = $productData['short_description'];
        $product->long_description = $productData['long_description'];
        $product->video_url = $productData['video_url'];
        $product->sku = $productData['sku'];
        $product->price = $productData['price'];
        $product->offer_price = $productData['offer_price'];
        $product->offer_start_date = $productData['offer_start_date'];
        $product->offer_end_date = $productData['offer_end_date'];
        $product->product_type = $productData['product_type'];
        $product->status = $productData['status'];
        $product->is_approved = 1;
        $product->seo_title = $productData['seo_title'];
        $product->seo_description = $productData['seo_description'];

        $product->save();
    }

    public function deleteProduct(string $id)
    {
        $product = Product::findOrFail($id);
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

    public function updateStatus($request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();
    }
}
