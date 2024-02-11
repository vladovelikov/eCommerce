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
}
