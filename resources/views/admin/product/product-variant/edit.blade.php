@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant</h1>
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
                            <h4>Update Variant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.products-variants.update', $productVariant->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$productVariant->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$productVariant->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$productVariant->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
