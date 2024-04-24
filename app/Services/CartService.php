<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartService
{

    public function addProduct(array $productData): bool
    {
        $product = Product::with(['variants'])
            ->where('id', $productData['product_id'])
            ->first();

        if ($product->quantity < $productData['quantity']) {
            return false;
        }

        $variants = [];
        $variantsTotalAmount = 0;

        if (isset($productData['variant_items']) && $productData['variant_items']) {
            foreach ($productData['variant_items'] as $variantItemId) {
                $variantItem = ProductVariantItem::with(['productVariant'])
                    ->where('id', $variantItemId)
                    ->first();
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantsTotalAmount += $variantItem->price;
            }
        }

        $cartData = [];
        //TODO: add products weight
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantsTotalAmount;
        $cartData['options']['image'] = $product->image;
        $cartData['options']['seo_url'] = $product->seo_url;

        Cart::add(
            $product->id,
            $product->name,
            $productData['quantity'],
            isDiscounted($product) ? $product->offer_price : $product->price,
            10,
            $cartData['options']
        );

        return true;
    }

    public function getTotalAmount()
    {
        $subtotalAmount = 0;

        foreach (Cart::content() as $product) {
            $subtotalAmount += $this->calculateProductTotalAmount($product->rowId);
        }

        return [
            'subtotalAmount' => $subtotalAmount,
            'totalAmount' => getCartTotal()
        ];
    }

    public function calculateProductTotalAmount($rowId)
    {
        $product = Cart::get($rowId);

        return $product->price * $product->qty;
    }

    public function updateProductQuantity($rowId, $quantity)
    {
        $productId = Cart::get($rowId)->id;
        $product = Product::findOrFail($productId);

        if ($product->quantity < $quantity) {
            return false;
        }

        Cart::update($rowId, $quantity);

        $totalAmount = $this->calculateProductTotalAmount($rowId);

        return $totalAmount;
    }

    public function applyVoucher($voucherCode, $cartSubtotal)
    {
        $voucher = Voucher::where('code', $voucherCode)
            ->where('status', 1)
            ->where('valid_from', '<', now())
            ->where('valid_to', '>', now())
            ->first();

        if (!$voucher || $voucher->total_used >= $voucher->quantity) {
            return false;
        }

//        $voucherDiscount = $voucher->discount_type === Voucher::DISCOUNT_TYPE_PERCENTAGE
//            ? $cartSubtotal * ($voucher->discount_value / 100)
//            : $voucher->discount_value;

        Session::put('voucher', [
            'name' => $voucher->name,
            'code' => $voucher->code,
            'discount_type' => $voucher->discount_type,
            'discount' => $voucher->discount_value
        ]);

        return true;
    }

    public function calculateDiscount()
    {
        if (Session::has('voucher')) {
            $voucher = Session::get('voucher');
            $cartSubtotal = $this->getSubtotalAmount();

            if ($voucher['discount_type'] == Voucher::DISCOUNT_TYPE_PERCENTAGE) {
                $cartData['discount'] = round($cartSubtotal * ($voucher['discount'] / 100), 2);
                $cartData['subtotal'] = round($cartSubtotal - $cartData['discount'], 2);
            } else {
                $cartData['discount'] = round($voucher['discount'], 2);
                $cartData['subtotal'] = round($cartSubtotal - $voucher['discount'], 2);
            }

            return $cartData;
        }

        return false;
    }

    public function clearCart()
    {
        Cart::destroy();

        if (Session::has('voucher')) {
            Session::forget('voucher');
        }
    }

}
