@extends('vendor.layouts.master')

@section('title')
    {{$settings->website_name}}
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Update Variant Item ({{$productVariantItem->productVariant->name}} - {{$productVariantItem->name}})</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.product-variant-items.update', $productVariantItem->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label>Variant Name</label>
                                        <input type="text" name="variant_name" class="form-control" value="{{$productVariantItem->productVariant->name}}" readonly>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Item Name</label>
                                        <input type="text" name="item_name" class="form-control" value="{{$productVariantItem->name}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Price</label>
                                        <input type="text" name="price" class="form-control" value="{{$productVariantItem->price}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Is Default</label>
                                        <select id="status" name="is_default" class="form-control">
                                            <option {{$productVariantItem->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$productVariantItem->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option {{$productVariantItem->is_default == 1 ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$productVariantItem->is_default == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

