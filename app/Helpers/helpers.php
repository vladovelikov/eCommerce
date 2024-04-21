<?php

use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

/** Set Sidebar item active */
function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

/** Check if a product is discounted */
function isDiscounted($product): bool
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price
        && $currentDate >= $product->offer_start_date
        && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

/** Get product type */
function productType(string $type): string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best product':
            return 'Best';
            break;
        default:
            return '';

    }
}

/** Get cart subtotal amount */
function getCartSubtotal()
{
    $subtotalAmount = 0;

    foreach (Cart::content() as $product) {
        $subtotalAmount += $product->price * $product->qty;
    }

    return $subtotalAmount;
}

/** Get cart total payable amount */
function getCartTotal()
{
    if (Session::has('voucher')) {
        $voucher = Session::get('voucher');
        $cartSubtotal = getCartSubtotal();

        if ($voucher['discount_type'] == Voucher::DISCOUNT_TYPE_PERCENTAGE) {
            $cartDiscount = round($cartSubtotal * ($voucher['discount'] / 100), 2);
            $cartTotal = round($cartSubtotal - $cartDiscount, 2);
        } else {
            $cartTotal = round($cartSubtotal - $voucher['discount'], 2);
        }

        return $cartTotal;
    } else {
        return getCartSubtotal();
    }
}

/** Get cart discount */
function getCartDiscount()
{
    if (Session::has('voucher')) {
        $voucher = Session::get('voucher');
        $cartSubtotal = getCartSubtotal();

        if ($voucher['discount_type'] == Voucher::DISCOUNT_TYPE_PERCENTAGE) {
            return round($cartSubtotal * ($voucher['discount'] / 100), 2);
        } else {
            return round($voucher['discount'], 2);
        }

    } else {
        return 0;
    }
}
