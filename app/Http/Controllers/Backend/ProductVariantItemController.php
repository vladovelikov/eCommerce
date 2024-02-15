<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{

    public function index(Request $request, ProductVariantItemDataTable $dataTable)
    {
        $product = Product::findOrFail($request->productId);
        $productVariant = ProductVariant::findOrFail($request->variantId);

        return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'productVariant'));
    }

    public function create(string $productId, string $variantId)
    {
        $product = Product::findOrFail($productId);
        $productVariant = ProductVariant::findOrFail($variantId);

        return view('admin.product.product-variant-item.create', compact('product', 'productVariant'));
    }

    public function edit(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->variantItemId);

        return view('admin.product.product-variant-item.edit', compact('productVariantItem'));
    }

    /**
     * Update the product variant item status.
     */
    public function updateStatus(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->id);
        $productVariantItem->status = $request->status == 'true' ? 1 : 0;
        $productVariantItem->save();

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'max:200'],
            'price' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = ProductVariantItem::findOrFail($request->variantItemId);
        $productVariantItem->name = $request->item_name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin.product-variant-items.index', ['productId' => $productVariantItem->productVariant->product_id,
            'variantId' => $productVariantItem->product_variant_id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => ['integer', 'required'],
            'item_name' => ['required', 'max:200'],
            'price' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = new ProductVariantItem();
        $productVariantItem->product_variant_id = $request->variant_id;
        $productVariantItem->name = $request->item_name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.product-variant-items.index', ['productId' => $request->product_id,
            'variantId' => $request->variant_id]);
    }

    public function destroy(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->variantItemId);
        $productVariantItem->delete();

        return response([
            'status' => 'success',
            'message' => 'Variant item deleted successfully!'
        ]);
    }
}
