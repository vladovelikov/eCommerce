@extends('frontend.dashboard.layouts.master')

@section('title')
    {{$settings->website_name}}
@endsection

@section('content')
    <!--=============================
  DASHBOARD START
==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="dashboard_sidebar">
        <span class="close_icon">
          <i class="far fa-bars dash_bar"></i>
          <i class="far fa-times dash_close"></i>
        </span>
                <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
                <ul class="dashboard_link">
                    <li><a href="dsahboard.html"><i class="fas fa-tachometer"></i>Dashboard</a></li>
                    <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> Orders</a></li>
                    <li><a href="dsahboard_download.html"><i class="far fa-cloud-download-alt"></i> Downloads</a></li>
                    <li><a href="dsahboard_review.html"><i class="far fa-star"></i> Reviews</a></li>
                    <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
                    <li><a href="dsahboard_profile.html"><i class="far fa-user"></i> My Profile</a></li>
                    <li><a class="active" href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
                    <li><a href="#"><i class="far fa-sign-out-alt"></i> Log out</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fal fa-gift-card"></i>update address</h3>
                        <div class="wsus__dashboard_add wsus__add_address">
                            <form action="{{route('user.addresses.update', $address->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>name <b>*</b></label>
                                            <input type="text" placeholder="Name" name="name" value="{{$address->name}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>email</label>
                                            <input type="email" placeholder="Email" name="email" value="{{$address->email}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>phone <b>*</b></label>
                                            <input type="text" placeholder="Phone" name="phone" value="{{$address->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>country <b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="country">
                                                    <option>Select</option>
                                                    @foreach(config('settings.country_list') as $country)
                                                        <option {{$address->country == $country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>state <b>*</b></label>
                                            <input type="text" placeholder="State" name="state" value="{{$address->state}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>city <b>*</b></label>
                                            <input type="text" placeholder="City" name="city" value="{{$address->city}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>zip code <b>*</b></label>
                                            <input type="text" placeholder="Zip Code" name="zip_code" value="{{$address->zip_code}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>street <b>*</b></label>
                                            <input type="text" placeholder="Street" name="street" value="{{$address->street}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <button type="submit" class="common_btn">update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
      DASHBOARD END
    ==============================-->
@endsection
