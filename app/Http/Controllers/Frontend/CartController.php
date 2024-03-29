<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(private CartService $cartService)
    {
    }


    /** Add item to cart */
    public function addToCart(AddToCartRequest $request)
    {
        $this->cartService->addProduct($request->validated());

        return response([
            'status' => 'success',
            'message' => 'Added to cart successfully!'
        ]);
    }

    /** Show cart details page */
    public function cartDetails(Request $request)
    {
        $cartItems = Cart::content();

        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    public function updateProductQuantity(Request $request)
    {
        $rowId = $request->input('rowId');
        $quantity = $request->input('quantity');

        Cart::update($rowId, $quantity);

        $totalAmount = $this->cartService->calculateProductTotalAmount($rowId);

        return response([
            'status' => 'success',
            'message' => 'Product quantity updated successfully!',
            'totalAmount' => $totalAmount
        ]);
    }

}
