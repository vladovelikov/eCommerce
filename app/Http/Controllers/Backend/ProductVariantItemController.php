<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantItemRequest;
use App\Http\Requests\UpdateProductVariantItemRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use App\Services\ProductVariantItemService;

class ProductVariantItemController extends Controller
{


    public function __construct(private ProductVariantItemService $productVariantItemService)
    {
    }

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
        $this->productVariantItemService->updateVariantItemStatus($request->id, $request->status);

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }

    public function update(UpdateProductVariantItemRequest $request)
    {
        $productVariantItem = $this->productVariantItemService->updateVariantItem($request->validated());

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin.product-variant-items.index', ['productId' => $productVariantItem->productVariant->product_id,
            'variantId' => $productVariantItem->product_variant_id]);
    }

    public function store(StoreProductVariantItemRequest $request)
    {
        $this->productVariantItemService->saveVariantItem($request->validated());

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
