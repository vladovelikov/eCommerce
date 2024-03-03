<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{

    public function index(SellerProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-product.index');
    }

    public function pendingProducts(SellerPendingProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-pending-product.index');
    }

    public function updateApprovalStatus(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $product->is_approved = $request->isApproved;
        $product->save();

        return response([
            'status' => 'success',
            'message' => 'Product approval status updated successfully'
        ]);
    }

}
