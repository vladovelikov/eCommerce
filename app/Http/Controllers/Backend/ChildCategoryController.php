<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildCategoryRequest;
use App\Http\Requests\UpdateChildCategoryRequest;
use App\Http\Requests\UpdateChildCategoryStatusRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.child-category.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildCategoryRequest $request)
    {
        ChildCategory::create($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.child-category.index');
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
        $childCategory = ChildCategory::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $childCategory->category_id)->get();

        return view('admin.child-category.edit', compact('childCategory','categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildCategoryRequest $request, string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->fill($request->validated());
        $childCategory->save();

        toastr('Updated successfully!', 'success');

        return redirect()->route('admin.child-category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully!'
        ]);
    }

    /**
     * Get subcategories.
     */
    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->id)
            ->where('status', 1)
            ->get();

        return $subcategories;
    }

    public function updateStatus(UpdateChildCategoryStatusRequest $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->status = $request->status == 'true' ? 1 : 0;
        $childCategory->save();

        return response([
            'message' => 'Status updated successfully!'
        ]);
    }
}
