@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create Product</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.products.update', $product->id)}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label>Preview</label>
                                        <br>
                                        <img src="{{asset($product->image)}}" style="width: 200px;" alt="">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Category</label>
                                                <select id="status" class="form-control main-category" name="category">
                                                    <option value="">Select</option>
                                                    @foreach($categories as $category)
                                                        <option {{$product->category_id == $category->id ? 'selected' : ''}} value={{$category->id}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Subcategory</label>
                                                <select id="status" class="form-control sub-category" name="subcategory">
                                                    <option value="">Select</option>
                                                    @foreach($subcategories as $subcategory)
                                                        <option {{$product->subcategory_id == $subcategory->id ? 'selected' : ''}} value={{$subcategory->id}}>{{$subcategory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Child Category</label>
                                                <select id="status" class="form-control child-category"
                                                        name="child_category">
                                                    <option value="">Select</option>
                                                    @foreach($childCategories as $childCategory)
                                                        <option {{$product->child_category_id == $childCategory->id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Brand</label>
                                        <select id="status" class="form-control" name="brand_id">
                                            <option value="">Select</option>
                                            @foreach($brands as $brand)
                                                <option {{$product->brand_id == $brand->id ? 'selected' : ''}} value={{$brand->id}}>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input ">
                                        <label>SKU</label>
                                        <input type="text" name="sku" class="form-control" value="{{$product->sku}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Price</label>
                                        <input type="text" name="price" class="form-control" value="{{$product->price}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Offer Price</label>
                                        <input type="text" name="offer_price" class="form-control"
                                               value="{{$product->offer_price}}">
                                    </div>
                                    <div class="row">
                                        <div class="col md-6">
                                            <div class="form-group wsus__input">
                                                <label>Offer Start Date</label>
                                                <input type="date" name="offer_start_date" class="form-control datepicker"
                                                       value="{{$product->offer_start_date}}">
                                            </div>
                                        </div>
                                        <div class="col md-6">
                                            <div class="form-group wsus__input ">
                                                <label>Offer End Date</label>
                                                <input type="date" name="offer_end_date" class="form-control datepicker"
                                                       value="{{$product->offer_end_date}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Stock Quantity</label>
                                        <input type="number" min="0" name="qty" class="form-control" value="{{$product->quantity}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Video URL</label>
                                        <input type="text" name="video_url" class="form-control"
                                               value="{{$product->video_url}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Long Description</label>
                                        <textarea name="long_description" class="form-control">{!! $product->long_description !!}</textarea>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Product Type</label>
                                        <select id="status" name="product_type" class="form-control">
                                            <option value="">Select</option>
                                            <option {{$product->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New Arrival</option>
                                            <option {{$product->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">Featured</option>
                                            <option {{$product->product_type == 'top_product' ? 'selected' : ''}} value="best_product">Top Product</option>
                                            <option {{$product->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Best Product</option>
                                        </select>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" value="{{$product->seo_title}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>SEO Description</label>
                                        <textarea name="seo_description" class="form-control">{{$product->seo_description}}</textarea>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="">Select</option>
                                            <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('change', '.main-category', function (e) {
                $('.child-category').html(`<option id="">Select</option>`);
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('vendor.product.get-subcategories')}}",
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
                    url: "{{route('vendor.product.get-child-categories')}}",
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

