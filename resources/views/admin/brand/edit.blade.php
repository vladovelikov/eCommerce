@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
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
                            <h4>Update Brand</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img width="200" src="{{ asset($brand->logo) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$brand->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Featured</label>
                                    <select id="is_featured" name="is_featured" class="form-control">
                                        <option {{$brand->is_featured == 1 ? 'selected' : ''}} value="1">Yes</option>
                                        <option {{$brand->is_featured == 0 ? 'selected' : ''}} value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$brand->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$brand->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
