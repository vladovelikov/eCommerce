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
                        <h3><i class="far fa-user"></i> Shop profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label>Preview</label>
                                        <br>
                                        <img src="{{asset($profile->banner)}}" width="200px" alt="">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Banner</label>
                                        <input type="file" name="banner" class="form-control">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Shop Name</label>
                                        <input type="text" name="shop_name" class="form-control" value="{{$profile->shop_name}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{$profile->phone}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="{{$profile->email}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$profile->address}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control" value="{{$profile->description}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Facebook</label>
                                        <input type="text" name="fb_link" class="form-control" value="{{$profile->fb_link}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Twitter</label>
                                        <input type="text" name="tw_link" class="form-control" value="{{$profile->tw_link}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Instagram</label>
                                        <input type="text" name="insta_link" class="form-control" value="{{$profile->insta_link}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-top: 9px;">Update</button>
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
