<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchSidebarCartProducts();

        //add product into cart
        $('.shopping-cart-form').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{route('add-to-cart')}}",
                success: function(data) {
                    if (data.status === 'success') {
                        getCartCount();
                        fetchSidebarCartProducts();
                        getSidebarCartSubtotal();
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                     toastr.error(data.message);
                }
            })
        })

        //remove product from sidebar cart
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('row-id');

            $.ajax({
                method: 'POST',
                data: {
                    rowId: rowId
                },
                url: "{{route('cart.remove-sidebar-product')}}",
                success: function(data) {
                    getCartCount();
                    fetchSidebarCartProducts();
                    getSidebarCartSubtotal();

                    toastr.success(data.message);
                },
                error: function() {

                }
            })
        });

        //get sidebar cart subtotal
        function getSidebarCartSubtotal()
        {
            $.ajax({
                method: 'GET',
                url: "{{route('cart-subtotal')}}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("{{$settings->currency_icon}}" + data);
                },
                error: function() {

                }
            })
        }

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{route('cart-count')}}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function() {

                }
            })
        }

        //show products in sidebar cart
        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'GET',
                url: "{{route('cart-products')}}",
                success: function(data) {
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                            <li>
                                <div class="wsus__cart_img">
                                <a href="{{url("product-detail")}}/${product.options.seo_url}"><img src="{{asset("/")}}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                    <a class="wsis__del_icon remove_sidebar_product" data-row-id="${product.rowId}" href="#"><i class="fas fa-minus-circle"></i></a>
                                </div>
                                <div class="wsus__cart_text">
                                    <a class="wsus__cart_title" href="{{url("product-detail")}}/${product.options.seo_url}">${product.name}</a>
                                    <p>{{$settings->currency_icon}}${product.price}</p>
                                    <small>Quantity: ${product.qty}</small>
                                </div>
                            </li>`;
                    }

                    if (html !== '') {
                        $('.mini_cart_wrapper').html(html);
                        $('.mini_cart_actions').removeClass('d-none');
                    } else {
                        $('.mini_cart_wrapper').html('<li>Your shopping cart is empty</li>');
                        $('.mini_cart_actions').addClass('d-none');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    });
</script>
