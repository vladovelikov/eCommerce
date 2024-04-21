<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
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
        $isAdded = $this->cartService->addProduct($request->validated());

        if (!$isAdded) {
            return response([
                'status' => 'error',
                'message' => 'Quantity not available!'
            ]);
        }

        return response([
            'status' => 'success',
            'message' => 'Product added to cart successfully!'
        ]);
    }

    /** Show cart details page */
    public function cartDetails(Request $request)
    {
        $cartItems = Cart::content();

        if(count($cartItems) == 0) {
            return redirect()->route('index');
        }

        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    public function updateProductQuantity(Request $request)
    {
        $totalAmount = $this->cartService->updateProductQuantity(
            $request->input('rowId'),
            $request->input('quantity')
        );

        if (!$totalAmount) {
            return response([
                'status' => 'error',
                'message' => 'Quantity not available!'
            ]);
        }

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

    /** Fetch cart subtotal amount */
    public function getCartSubtotal()
    {
        return $this->cartService->getSubtotalAmount();
    }

    /** Clear all cart products */
    public function clearCart()
    {
        $this->cartService->clearCart();

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

    /** Adds a voucher to the cart */
    public function applyVoucher(Request $request)
    {
        $voucherCode = $request->input('voucherCode');

        if (!$voucherCode) {
            return response([
                'status' => 'error',
                'message' => 'Voucher code is required!'
            ]);
        }

        $cartSubtotal = $this->cartService->getSubtotalAmount();
        $voucherApplied = $this->cartService->applyVoucher($voucherCode, $cartSubtotal);

        if (!$voucherApplied) {
            return response([
                'status' => 'error',
                'message' => 'Voucher code is not valid!'
            ]);
        }

        return response([
            'status' => 'success',
            'message' => 'Voucher applied successfully!'
        ]);
    }

    /** Calculates voucher discount */
    public function calculateDiscount()
    {
        $cartData = $this->cartService->calculateDiscount();

        if (!$cartData) {
            return response([
                'status' => 'false',
                'message' => 'Error while calculating cart discount!'
            ]);
        }

        return response([
            'status' => 'success',
            'message' => 'Cart discount calculated successfully!',
            'cartTotal' => $cartData['subtotal'],
            'discount' => $cartData['discount']
        ]);
    }
}
