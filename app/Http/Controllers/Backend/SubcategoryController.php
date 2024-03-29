<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryStatusRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(SubcategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoryRequest $request)
    {
        Subcategory::create($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.subcategory.index');

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
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoryRequest $request, string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        Subcategory::fill($request->validated());
        $subcategory->save();

        toastr('Subcategory updated successfully!', 'success');

        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Update subcategory status.
     */
    public function updateStatus(UpdateSubcategoryStatusRequest $request)
    {
        $subcategory = Subcategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();

        return response([
            'message' => 'Subcategory status updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $childCategoriesCount = ChildCategory::where('subcategory_id', $id)->count();

        if ($childCategoriesCount > 0) {
            return response([
                'status' => 'error',
                'message' => 'This subcategory has child categories. Please delete the related child categories first.'
            ]);
        }

        $subcategory->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully!'
        ]);
    }
}
