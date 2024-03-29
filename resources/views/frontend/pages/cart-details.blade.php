@extends('frontend.layouts.master')

@section('title')
    {{$settings->website_name}} || Cart Details
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name">
                                        product details
                                    </th>

                                    <th class="wsus__pro_status">
                                        status
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_tk">
                                        price
                                    </th>

                                    <th class="wsus__pro_icon">
                                        <a href="#" class="common_btn">clear cart</a>
                                    </th>
                                </tr>
                                @foreach($cartItems as $cartItem)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($cartItem->options->image)}}"
                                                                       alt="product"
                                                                       class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{!! $cartItem->name !!}</p>
                                            @if($cartItem->options->variants)
                                                @foreach($cartItem->options->variants as $key => $variant)
                                                    <span>{{$key}}: {{$variant['name']}}</span>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="wsus__pro_status">
                                            @if($cartItem->options->in_stock)
                                                <p>in stock</p>
                                            @else
                                                <p>out of stock</p>
                                            @endif
                                        </td>

{{--                                        <td class="wsus__pro_select">--}}
{{--                                            <form class="select_number">--}}
{{--                                                <input class="number_area" type="text" min="1" max="100" value="1"/>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}

                                        <td class="wsus__pro_select">
                                            <div class="product-qty-wrapper">
                                                <button class="quantity-decrement-btn">-</button>
                                                <input class="product-qty" data-row-id="{{$cartItem->rowId}}" type="text" min="1" max="100" value="1"/>
                                                <button class="quantity-increment-btn">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6>{{$settings->currency_icon}}{{$cartItem->price}}</h6>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="#"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity-increment-btn').on('click', function () {
                let input = $(this).siblings('.product-qty');
                let rowId = input.data('row-id');
                let quantity = parseInt(input.val()) + 1;
                input.val(quantity);

                $.ajax({
                    url: "{{route('cart.update-quantity')}}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        toastr.error(error.message);
                    }
                })
            });


            // $('.quantity-decrement-btn').on('click', function () {
            //     let input = $(this).siblings('.product-qty');
            //     let quantity = parseInt(input.val() - 1);
            //     if (quantity > 0) {
            //         input.val(quantity);
            //     }
            // });
        });
    </script>
@endpush
