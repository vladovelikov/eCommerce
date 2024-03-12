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

        $flashSaleProducts = Product::where('offer_start_date', '<=', date('Y-m-d'))
            ->where('offer_end_date', '>=', date('Y-m-d'))
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(1);

        return view('frontend.pages.flash-sale', compact('flashSale', 'flashSaleProducts'));
    }
}
