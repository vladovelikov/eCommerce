<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductImageGalleryRequest;
use App\Models\Product;
use App\Services\ProductImageGalleryService;
use Illuminate\Http\Request;

class VendorProductImageGalleryController extends Controller
{

    public function __construct(private ProductImageGalleryService $productImageGalleryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductImageGalleryRequest $request)
    {
        $this->productImageGalleryService->saveProductImageGallery($request->validated());

        toastr('Uploaded Successfully!');

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productImageGalleryService->deleteProductImageGallery($id);

        return response([
            'status' => 'success',
            'message' => 'Deleted Successfully!'
        ]);
    }
}
