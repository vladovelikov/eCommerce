<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{

    public function addProduct(array $productData)
    {
        $product = Product::with(['variants'])
            ->where('id', $productData['product_id'])
            ->first();

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

    }

    public function calculateProductTotalAmount($rowId)
    {
        $product = Cart::get($rowId);

        return $product->price * $product->qty;
    }

}
