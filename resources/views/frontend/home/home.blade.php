@extends('frontend.layouts.master')

@section('title')
    {{$settings->website_name}}
@endsection

@section('content')

<!--============================
    BANNER PART 2 START
==============================-->
@include('frontend.home.sections.banner-slider')
<!--============================
    BANNER PART 2 END
==============================-->


<!--============================
    FLASH SELL START
==============================-->
@include('frontend.home.sections.flash-sale')
<!--============================
    FLASH SELL END
==============================-->


<!--============================
   MONTHLY TOP PRODUCT START
==============================-->
@include('frontend.home.sections.monthly-top-product')
<!--============================
   MONTHLY TOP PRODUCT END
==============================-->


<!--============================
    BRAND SLIDER START
==============================-->
@include('frontend.home.sections.brand-slider')
<!--============================
    BRAND SLIDER END
==============================-->


<!--============================
    SINGLE BANNER START
==============================-->
@include('frontend.home.sections.single-banner')
<!--============================
    SINGLE BANNER END
==============================-->


<!--============================
    HOT DEALS START
==============================-->
@include('frontend.home.sections.hot-deals')
<!--============================
    HOT DEALS END
==============================-->


<!--============================
    ELECTRONIC PART START
==============================-->
@include('frontend.home.sections.first-category-product-slider')
<!--============================
    ELECTRONIC PART END
==============================-->


<!--============================
    ELECTRONIC PART START
==============================-->
@include('frontend.home.sections.second-category-product-slider')
<!--============================
    ELECTRONIC PART END
==============================-->


<!--============================
    LARGE BANNER  START
==============================-->
@include('frontend.home.sections.large-banner')
<!--============================
    LARGE BANNER  END
==============================-->


<!--============================
    WEEKLY BEST ITEM START
==============================-->
@include('frontend.home.sections.weekly-best-item')
<!--============================
    WEEKLY BEST ITEM END
==============================-->


<!--============================
  HOME SERVICES START
==============================-->
@include('frontend.home.sections.services')
<!--============================
    HOME SERVICES END
==============================-->


<!--============================
    HOME BLOGS START
==============================-->
@include('frontend.home.sections.blogs')
<!--============================
    HOME BLOGS END
==============================-->
@endsection
