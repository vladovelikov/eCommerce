@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
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
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.products.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select id="status" class="form-control main-category" name="category">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option value={{$category->id}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Subcategory</label>
                                            <select id="status" class="form-control sub-category" name="subcategory">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child Category</label>
                                            <select id="status" class="form-control child-category"
                                                    name="child_category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select id="status" class="form-control" name="brand">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option value={{$brand->id}}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{old('sku')}}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" value="{{old('price')}}">
                                </div>
                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" name="offer_price" class="form-control"
                                           value="{{old('offer_price')}}">
                                </div>
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="date" name="offer_start_date" class="form-control datepicker"
                                                   value="{{old('offer_start_date')}}">
                                        </div>
                                    </div>
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="date" name="offer_end_date" class="form-control datepicker"
                                                   value="{{old('offer_end_date')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="number" min="0" name="qty" class="form-control" value="{{old('qty')}}">
                                </div>
                                <div class="form-group">
                                    <label>Video URL</label>
                                    <input type="number" min="0" name="video_url" class="form-control"
                                           value="{{old('video_url')}}">
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Type</label>
                                    <select id="status" name="product_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="new_arrival">New Arrival</option>
                                        <option value="featured_product">Featured</option>
                                        <option value="best_product">Top Product</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control"
                                           value="{{old('seo_title')}}">
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" class="form-control"
                                              value="{{old('seo_description')}}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
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
        $(document).ready(function () {
            $('body').on('change', '.main-category', function (e) {
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-subcategories')}}",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('.sub-category').html(`<option id="">Select</option>`);
                        $.each(data, function (i, item) {
                            $('.sub-category').append(`<option id="${item.id}" value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function (xhr, status, error) {
                        console.log(error)
                    }
                })
            })

            $('body').on('change', '.sub-category', function (e) {
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('.child-category').html(`<option id="">Select</option>`);
                        $.each(data, function (i, item) {
                            $('.child-category').append(`<option id="${item.id}" value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function (xhr, status, error) {
                        console.log(error)
                    }
                })
            })
        });
    </script>
@endpush


