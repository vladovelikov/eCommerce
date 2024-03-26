<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();

        return view('frontend.dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request)
    {
        UserAddress::create($request->validated());

        toastr('Created successfully!', 'success');

        return redirect()->route('user.addresses.index');
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
        $address = UserAddress::findOrFail($id);

        return view('frontend.dashboard.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, string $id)
    {
        $userAddress = UserAddress::findOrFail($id);
        $userAddress->fill($request->validated());
        $userAddress->save();

        toastr('Updated successfully!', 'success');

        return redirect()->route('user.addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userAddress = UserAddress::findOrFail($id);
        $userAddress->delete();

        return response([
            'status' => 'success',
            'message' => 'Address deleted successfully!'
        ]);
    }
}
