@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Variant Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.product-variant-items.update', $productVariantItem->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" name="variant_name" class="form-control" value="{{$productVariantItem->productVariant->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="item_name" class="form-control" value="{{$productVariantItem->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" value="{{$productVariantItem->price}}">
                                </div>
                                <div class="form-group">
                                    <label>Is Default</label>
                                    <select id="status" name="is_default" class="form-control">
                                        <option {{$productVariantItem->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                                        <option {{$productVariantItem->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$productVariantItem->is_default == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$productVariantItem->is_default == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
