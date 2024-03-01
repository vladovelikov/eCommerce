<?php

namespace App\Services;

use App\Models\ProductVariantItem;

class ProductVariantItemService
{

    public function saveVariantItem(array $variantItemData)
    {
        $productVariantItem = new ProductVariantItem();
        $productVariantItem->product_variant_id = $variantItemData['variant_id'];
        $productVariantItem->name = $variantItemData['item_name'];
        $productVariantItem->price = $variantItemData['price'];
        $productVariantItem->is_default = $variantItemData['is_default'];
        $productVariantItem->status = $variantItemData['status'];

        $productVariantItem->save();
    }

    public function updateVariantItem(array $variantItemData, $id)
    {
        $productVariantItem = ProductVariantItem::findOrFail($id);
        $productVariantItem->name = $variantItemData['item_name'];
        $productVariantItem->price = $variantItemData['price'];
        $productVariantItem->is_default = $variantItemData['is_default'];
        $productVariantItem->status = $variantItemData['status'];

        $productVariantItem->save();

        return $productVariantItem;
    }

    public function updateVariantItemStatus(string $variantItemId, $status)
    {
        $productVariantItem = ProductVariantItem::findOrFail($variantItemId);
        $productVariantItem->status = $status == 'true' ? 1 : 0;

        $productVariantItem->save();
    }
}
