<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    public function showProduct(string $seoUrl)
    {
        $product = Product::with(['vendor', 'category', 'productImageGallery', 'variants', 'variants.productVariantItems'])
            ->where('seo_url', $seoUrl)
            ->where('status', 1)
            ->first();

        return view('frontend.pages.product-detail', compact('product'));
    }

}
