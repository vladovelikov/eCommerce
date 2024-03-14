<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function showProduct(string $seoUrl)
    {
        $product = Product::where('seo_url', $seoUrl)
            ->where('status', 1)
            ->first();

        return view('frontend.pages.product-detail', compact('product'));
    }

}
