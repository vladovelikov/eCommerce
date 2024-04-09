<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/assets/images/flash_sell_bg.jpg')}}">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('flash-sale')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach($flashSaleProducts as $product)
            <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">{{ productType($product->product_type) }}</span>
                        @if(isDiscounted($product))
                            <span class="wsus__minus">-{{ $flashSale->discount_percentage }}%</span>
                        @endif
                        <a class="wsus__pro_link" href="{{route('product-details', $product->seo_url)}}">
                            <img src="{{asset($product->image)}}" alt="product" class="img-fluid w-100 img_1"/>
                            <img src="
                                @if(isset($product->productImageGallery[1]->image))
                                    {{asset($product->productImageGallery[1]->image)}}
                                @else
                                    {{asset($product->image)}}
                                @endif
                            " alt="product" class="img-fluid w-100 img_2"/>
                        </a>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="{{route('product-details', $product->seo_url)}}">{{$product->name}}</a>
                            @if(isDiscounted($product))
                                <p class="wsus__price">{{$settings->currency_icon}}{{$product->offer_price}}
                                    <del>{{$settings->currency_icon}}{{$product->price}}</del>
                                </p>
                            @else
                                <p class="wsus__price">{{$settings->currency_icon}}{{$product->price}}</p>
                            @endif
                            <form method="POST" class="shopping-cart-form">
                                @csrf
                                @foreach($product->variants as $variant)
                                        <select class="d-none" name="variant_items[]">
                                            @foreach($variant->productVariantItems as $variantItem)
                                                <option {{$variantItem->is_default == 1 ? 'selected' : ''}} value="{{$variantItem->id}}">{{$variantItem->name}}</option>
                                            @endforeach
                                        </select>
                                @endforeach
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="quantity" type="text" min="1" max="1" value="1"/>
                                <button type="submit" class="add_cart">add to cart</button>
                            </form>
                        </div>
                    </div>
            </div>
                @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function () {
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSale->end_date)) }},
                month: {{ date('m', strtotime($flashSale->end_date)) }},
                day: {{ date('d', strtotime($flashSale->end_date)) }}
            })
        });
    </script>
@endpush
