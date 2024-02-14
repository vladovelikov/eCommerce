<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\Subcategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $product = new Product();
        $product->image = $imagePath;
        $product->name = $request->name;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->quantity = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_url = $request->video_url;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.products.index');
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

        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->image);

        $product->image = empty(!$imagePath) ? $imagePath : $product->image;
        $product->name = $request->name;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->quantity = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_url = $request->video_url;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.products.index');
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
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $productImages = ProductImageGallery::where('product_id', $product->id)->get();

        //Delete the main product image
        $this->deleteImage($product->image);

        //Delete the product gallery images
        foreach ($productImages as $productImage) {
            $this->deleteImage($productImage->image);
            $productImage->delete();
        }

        //Delete product variants if exist
        $productVariants = ProductVariant::where('product_id', $product->id)->get();

        foreach ($productVariants as $productVariant) {
            $productVariant->productVariantItems()->delete();
            $productVariant->delete();
        }

        $product->delete();

        return response([
            'status' => 'success',
            'message' => 'Product deleted successfully!'
        ]);

    }
}
