<?php

namespace App\Services;

use App\Models\ProductVariant;
use App\Models\ProductVariantItem;

class ProductVariantService
{

    public function saveVariant(array $variantData)
    {
        $productVariant = new ProductVariant();
        $productVariant->name = $variantData['name'];
        $productVariant->status = $variantData['status'];
        $productVariant->product_id = $variantData['product_id'];

        $productVariant->save();
    }

    public function updateVariant(array $variantData, string $id): ProductVariant
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $variantData['name'];
        $productVariant->status = $variantData['status'];
        $productVariant->save();

        return $productVariant;
    }

    public function deleteVariant(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $variantItemsCount = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();

        if ($variantItemsCount > 0) {
            return false;
        }

        $productVariant->delete();

        return true;
    }

    public function updateVariantStatus(string $id, $status)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->status = $status == 'true' ? 1 : 0;

        $productVariant->save();
    }

}
