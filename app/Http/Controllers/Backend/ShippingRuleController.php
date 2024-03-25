<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingRuleRequest;
use App\Http\Requests\UpdateShippingRuleRequest;
use App\Http\Requests\UpdateShippingRuleStatusRequest;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRuleRequest $request)
    {
        ShippingRule::create($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('admin.shipping-rules.index');
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
        $shippingRule = ShippingRule::findOrFail($id);

        return view('admin.shipping-rule.edit', compact('shippingRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRuleRequest $request, string $id)
    {
        $shippingRule = ShippingRule::findOrFail($id);
        $shippingRule->fill($request->validated());
        $shippingRule->save();

        toastr('Updated successfully!', 'success');

        return redirect()->route('admin.shipping-rules.index');
    }

    /**
     * Update subcategory status.
     */
    public function updateStatus(UpdateShippingRuleStatusRequest $request)
    {
        $shippingRule = ShippingRule::findOrFail($request->id);
        $shippingRule->status = $request->status == 'true' ? 1 : 0;
        $shippingRule->save();

        return response([
            'message' => 'Shipping rule status updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingRule = ShippingRule::findOrFail($id);
        $shippingRule->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ]);
    }
}
