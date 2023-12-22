<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'unique:subcategories,name', 'max:200'],
            'status' => ['required']
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;

        $subcategory->save();

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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'unique:subcategories,name,' . $id, 'max:200'],
            'status' => ['required']
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr('Subcategory updated successfully!', 'success');

        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Update subcategory status.
     */
    public function updateStatus(Request $request)
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
        $subcategory->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully!'
        ]);
    }
}
