@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>
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
                            <h4>Update Vendor Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{asset($profile->banner)}}" width="200px" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{$profile->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$profile->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{$profile->address}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control" value="{{$profile->description}}">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="fb_link" class="form-control" value="{{$profile->fb_link}}">
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="tw_link" class="form-control" value="{{$profile->tw_link}}">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="insta_link" class="form-control" value="{{$profile->insta_link}}">
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
