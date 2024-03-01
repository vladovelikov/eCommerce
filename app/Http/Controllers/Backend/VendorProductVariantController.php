<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{

    public function __construct(private ProductVariantService $productVariantService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        return $dataTable->render('vendor.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductVariantRequest $request)
    {
        $this->productVariantService->saveVariant($request->validated());

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variants.index', ['product' => $request->product_id]);
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

        return view('vendor.product.product-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductVariantRequest $request, string $id)
    {
        $productVariant = $this->productVariantService->updateVariant($request->validated(), $id);

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variants.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $success = $this->productVariantService->deleteVariant($id);

        if ($success) {
            return response([
                'status' => 'success',
                'message' => 'Product variant deleted successfully!'
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'This product variant contains variant items. In order to proceed, please delete all related variant items.'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $this->productVariantService->updateVariantStatus($request->id, $request->status);

        return response([
            'status' => 'success',
            'message' => 'Product variant status updated successfully'
        ]);
    }
}
