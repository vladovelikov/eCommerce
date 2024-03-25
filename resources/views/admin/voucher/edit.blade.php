@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Voucher</h1>
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
                            <h4>Update Voucher</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.vouchers.update', $voucher->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$voucher->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" class="form-control" value="{{$voucher->code}}">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" value="{{$voucher->quantity}}">
                                </div>
                                <div class="form-group">
                                    <label>Max uses per customer</label>
                                    <input type="text" name="max_use" class="form-control" value="{{$voucher->max_use}}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valid from</label>
                                            <input type="date" name="valid_from" class="form-control datepicker" value="{{$voucher->valid_from}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valid to</label>
                                            <input type="date" name="valid_to" class="form-control datepicker" value="{{$voucher->valid_to}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Type</label>
                                            <select id="status" name="discount_type" class="form-control main-category">
                                                <option value="">Select</option>
                                                <option {{$voucher->discount_type == 'amount' ? 'selected' : ''}} value="amount">Amount</option>
                                                <option {{$voucher->discount_type == 'percentage' ? 'selected' : ''}} value="percentage">Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Value</label>
                                            <input type="text" name="discount_value" class="form-control" value="{{$voucher->discount_value}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$voucher->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$voucher->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
