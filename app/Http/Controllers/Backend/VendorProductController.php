<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorProductRequest;
use App\Http\Requests\UpdateVendorProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorProductRequest $request)
    {
        $this->productService->saveProduct($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('vendor.products.index');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('subcategory_id', $product->subcategory_id)->get();
        $brands = Brand::all();

        return view('vendor.product.edit', compact('product', 'categories', 'subcategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorProductRequest $request, string $id)
    {
        $this->productService->updateProduct($request->validated(), $id);

        toastr('Updated successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->deleteProduct($id);

        return response([
            'status' => 'success',
            'message' => 'Product deleted successfully!'
        ]);
    }

    /**
     * Get all product subcategories.
     */
    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->id)->get();

        return $subcategories;
    }

    /**
     * Get all product child categories.
     */
    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('subcategory_id', $request->id)->get();

        return $childCategories;
    }

    /**
     * Update the product status.
     */
    public function updateStatus(Request $request)
    {
        $this->productService->updateStatus($request->id, $request->status);

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }
}
