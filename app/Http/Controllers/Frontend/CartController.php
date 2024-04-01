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
            'message' => 'Product added to cart successfully!'
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

    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Fetch cart products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /** Clear all cart products */
    public function clearCart(Request $request)
    {
        Cart::destroy();

        return response([
            'status' => 'success',
            'message' => 'Cart cleared successfully!'
        ]);
    }

    /** Remove product from sidebar cart */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response([
            'status' => 'success',
            'message' => 'Product removed successfully'
        ]);
    }

    /** Remove product from the cart */
    public function removeProduct(string $rowId)
    {
        Cart::remove($rowId);

        return redirect()->route('cart-details');
    }
}
