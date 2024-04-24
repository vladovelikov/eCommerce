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

                                    <th class="wsus__pro_tk">
                                        price per unit
                                    </th>

                                    <th class="wsus__pro_tk">
                                        sum
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_icon">
                                        <a href="#" class="common_btn clear_cart">clear cart</a>
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

                                        <td class="wsus__pro_tk">
                                            <h6>{{$settings->currency_icon}}{{$cartItem->price}}</h6>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6 id="{{$cartItem->rowId}}">{{$settings->currency_icon}}{{$cartItem->price * $cartItem->qty}}</h6>
                                        </td>

{{--                                        <td class="wsus__pro_select">--}}
{{--                                            <form class="select_number">--}}
{{--                                                <input class="number_area" type="text" min="1" max="100" value="1"/>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}

                                        <td class="wsus__pro_select">
                                            <div class="product-qty-wrapper">
                                                <button class="quantity-decrement-btn">-</button>
                                                <input class="product-qty" data-row-id="{{$cartItem->rowId}}" type="text" min="1" max="100" value="{{$cartItem->qty}}"/>
                                                <button class="quantity-increment-btn">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="{{route('cart.remove-product', $cartItem->rowId)}}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($cartItems) == 0)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_icon" rowspan="2" style="width: 100%;">
                                            Cart is empty!
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="subtotal">{{$settings->currency_icon}}{{getCartSubtotal()}}</span></p>
                        <p>discount: <span id="cart_discount">{{$settings->currency_icon}}{{getCartDiscount()}}</span></p>
                        <p class="total"><span>total:</span> <span id="cart_total">{{$settings->currency_icon}}{{getCartTotal()}}</span></p>

                        <form id="voucher_code">
                            <input type="text" name="voucher_code" placeholder="Voucher Code" value="{{session()->has('voucher') ? session()->get('voucher')['code'] : ''}}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{route('index')}}"><i
                                class="fab fa-shopify"></i> keep shopping</a>
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

            //increment product quantity
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
                            let productId = '#' + rowId;
                            $(productId).text("{{$settings->currency_icon}}" + response.totalAmount);
                            renderCartSubtotalAmount();
                            calculateVoucherDiscount();
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

            //decrement product quantity
            $('.quantity-decrement-btn').on('click', function () {
                let input = $(this).siblings('.product-qty');
                let rowId = input.data('row-id');
                let quantity = parseInt(input.val()) - 1;
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
                            let productId = '#' + rowId;
                            $(productId).text("{{$settings->currency_icon}}" + response.totalAmount);
                            renderCartSubtotalAmount();
                            calculateVoucherDiscount();
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

            //clear the cart
            $('.clear_cart').on('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: "{{route('cart.clear')}}",

                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Cart cleared successfully!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Unable to proceed with cart clearing!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        })

                    }
                })
            });

            //fetch subtotal amount and render it
            function renderCartSubtotalAmount()
            {
                $.ajax({
                    method: 'GET',
                    url: "{{route('cart-total')}}",
                    success: function(data) {
                        $('#subtotal').text("{{$settings->currency_icon}}" + data.subtotalAmount);
                        $('#cart_total').text("{{$settings->currency_icon}}" + data.totalAmount);
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            }

            //apply voucher code
            $('#voucher_code').on('submit', function (e) {
                e.preventDefault();
                let voucherCode = $(this).find('input').val();

                $.ajax({
                    method: 'POST',
                    url: "{{route('apply-voucher')}}",
                    data: {
                        voucherCode: voucherCode
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            calculateVoucherDiscount();
                            renderCartSubtotalAmount();
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            });

            //calculating voucher discount
            function calculateVoucherDiscount() {
                $.ajax({
                    method: 'GET',
                    url: "{{route('calculate-discount')}}",
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#cart_discount') .text("{{$settings->currency_icon}}" + data.discount);
                            $('#cart_total').text("{{$settings->currency_icon}}" + data.cartTotal);
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            }


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
