@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Subcategory</h1>
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
                            <h4>Edit Subcategory</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.subcategory.update', $subcategory->id)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label>Category</label>
                                    <select id="status" name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option {{$category->id == $subcategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$subcategory->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" {{$subcategory->status  == 1 ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$subcategory->status  == 0 ? 'selected' : ''}}>Inactive</option>
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
