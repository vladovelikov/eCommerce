<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantItemRequest;
use App\Http\Requests\UpdateProductVariantItemRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Services\ProductVariantItemService;
use Illuminate\Http\Request;

class VendorProductVariantItemController extends Controller
{

    public function __construct(private ProductVariantItemService $productVariantItemService)
    {
    }

    public function index(Request $request, VendorProductVariantItemDataTable $dataTable)
    {
        $product = Product::findOrFail($request->productId);
        $productVariant = ProductVariant::findOrFail($request->variantId);

        return $dataTable->render('vendor.product.product-variant-item.index', compact('product', 'productVariant'));
    }

    public function create(string $productId, string $variantId)
    {
        $product = Product::findOrFail($productId);
        $productVariant = ProductVariant::findOrFail($variantId);

        return view('vendor.product.product-variant-item.create', compact('product', 'productVariant'));
    }

    public function edit(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->variantItemId);

        return view('vendor.product.product-variant-item.edit', compact('productVariantItem'));
    }

    /**
     * Update the product variant item status.
     */
    public function updateStatus(Request $request)
    {
        $this->productVariantItemService->updateVariantItemStatus($request->id, $request->status);

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }

    public function update(UpdateProductVariantItemRequest $request, string $id)
    {
        $productVariantItem = $this->productVariantItemService->updateVariantItem($request->validated(), $id);

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('vendor.product-variant-items.index', ['productId' => $productVariantItem->productVariant->product_id,
            'variantId' => $productVariantItem->product_variant_id]);
    }

    public function store(StoreProductVariantItemRequest $request)
    {
        $this->productVariantItemService->saveVariantItem($request->validated());

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('vendor.product-variant-items.index', ['productId' => $request->product_id,
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
