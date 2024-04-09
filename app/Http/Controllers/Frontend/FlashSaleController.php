<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;

class FlashSaleController extends Controller
{

    public function index()
    {
        $flashSale = FlashSale::first();

        $flashSaleProducts = Product::with(['productImageGallery', 'variants', 'category'])
            ->where('offer_start_date', '<=', date('Y-m-d'))
            ->where('offer_end_date', '>=', date('Y-m-d'))
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->paginate(6);

        return view('frontend.pages.flash-sale', compact('flashSale', 'flashSaleProducts'));
    }
}
