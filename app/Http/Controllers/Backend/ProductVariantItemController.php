<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{

    public function index(Request $request, ProductVariantItemDataTable $dataTable)
    {
        $product = Product::findOrFail($request->productId);
        $productVariant = ProductVariant::findOrFail($request->variantId);

        return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'productVariant'));
    }
}
