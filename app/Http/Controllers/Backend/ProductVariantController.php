<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        return $dataTable->render('admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->product_id = $request->product;
        $productVariant->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.products-variants.index', ['product' => $request->product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        return view('admin.product.product-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin.products-variants.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $variantItemsCount = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();

        if ($variantItemsCount > 0) {
            return response([
                'status' => 'error',
                'message' => 'This product variant contains variant items. In order to proceed, please delete all related variant items.'
            ]);
        }

        $productVariant->delete();

        return response([
            'status' => 'success',
            'message' => 'Product variant deleted successfully!'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();

        return response([
            'status' => 'success',
            'message' => 'Product variant status updated successfully'
        ]);
    }
}
