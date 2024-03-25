<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VoucherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(VoucherDataTable $dataTable)
    {
        return $dataTable->render('admin.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $voucherData = $request->validated();
        $voucherData['total_used'] = 0;
        Voucher::create($voucherData);

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.vouchers.index');
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
        //
    }
}
