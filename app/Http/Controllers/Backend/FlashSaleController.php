<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlashSaleRequest;
use App\Http\Requests\UpdateFlashSaleRequest;
use App\Models\FlashSale;
use App\Models\Product;
use App\Services\FlashSaleService;

class FlashSaleController extends Controller
{

    public function __construct(private FlashSaleService $flashSaleService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index(FlashSaleDataTable $dataTable)
    {
        return $dataTable->render('admin.flash-sale.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.flash-sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlashSaleRequest $request)
    {
        $this->flashSaleService->saveFlashSale($request->validated());

        toastr()->success('Flash sale created successfully!', 'success');

        return redirect()->route('admin.flash-sale.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $flashSale->products = explode(";", $flashSale->products);
        $products = Product::all();

        return view('admin.flash-sale.edit', compact('flashSale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlashSaleRequest $request, string $id)
    {
        $this->flashSaleService->updateFlashSale($request->validated(), $id);

        toastr('Updated successfully!', 'success');

        return redirect()->route('admin.flash-sale.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->flashSaleService->deleteFlashSale($id);

        return response([
            'status' => 'success',
            'message' => 'Flash sale deleted successfully!'
        ]);
    }
}
