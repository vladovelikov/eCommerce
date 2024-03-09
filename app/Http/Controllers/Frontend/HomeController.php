<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{


    /**
     * Display the frontend home page.
     */
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('order', 'asc')->get();
        $flashSale = FlashSale::first();

        $flashSaleProducts = Product::where('offer_start_date', '<=', date('Y-m-d'))
            ->where('offer_end_date', '>=', date('Y-m-d'))
            ->where('status', 1)
            ->get();

        return view('frontend.home.home',
            compact('sliders',
            'flashSale',
            'flashSaleProducts'));
    }
}
