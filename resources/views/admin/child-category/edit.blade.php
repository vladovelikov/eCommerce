@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>
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
                            <h4>Update Child Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.child-category.update', $childCategory->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Category</label>
                                    <select id="status" name="category_id" class="form-control main-category">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option {{$category->id == $childCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Subcategory</label>
                                    <select id="status" name="subcategory_id" class="form-control sub-category">
                                        <option value="">Select</option>
                                        @foreach($subcategories as $subcategory)
                                            <option {{$subcategory->id == $childCategory->subcategory_id ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$childCategory->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$childCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$childCategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subcategories')}}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html(`<option id="">Select</option>`);
                        $.each(data, function (i, item) {
                            $('.sub-category').append(`<option id="${item.id}" value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                })
            })
        });
    </script>
@endpush
