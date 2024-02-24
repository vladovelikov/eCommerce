<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Services\BrandService;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct(private BrandService $brandService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $this->brandService->saveBrand($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $this->brandService->updateBrand($request->validated(), $id);

        toastr('Updated successfully!', 'success');

        return redirect()->route('admin.brand.index');
    }

    /**
     * Update the brand status.
     */
    public function updateStatus(Request $request)
    {
        $this->brandService->updateStatus($request->id, $request->status);

        return response([
            'message' => 'Brand status updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->brandService->deleteBrand($id);

        return redirect()->route('admin.brand.index');
    }
}
