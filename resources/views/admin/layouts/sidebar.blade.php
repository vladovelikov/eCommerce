<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">E-Commerce Shop</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown {{ setActive([
                'admin.settings.*',
                'admin.slider.*',
                'admin.category.*',
                'admin.subcategory.*',
                'admin.child-category.*',
                'admin.brand.*',
                'admin.vendor-profile.*',
                'admin.products.*',
                'admin.seller-products.*',
                'admin.seller-pending-products.*',
                'admin.product-variant-items.*',
                'admin.products-image-gallery.*',
                'admin.products-variants.*',
                'admin.flash-sale.*',
                'admin.shipping-rules.*',
                'admin.vouchers.*'
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.settings.*']) }}"><a class="nav-link" href="{{route('admin.settings.index')}}">General Settings</a></li>
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link" href="{{route('admin.category.index')}}">Categories</a></li>
                    <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link" href="{{route('admin.subcategory.index')}}">Subcategories</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Child categories</a></li>
{{--                    <li class="{{ setActive(['admin.product.*']) }}"><a class="nav-link" href="{{route('admin.product.index')}}">Products</a></li>--}}
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
                    <li class="{{ setActive(['admin.products.*', 'admin.product-variant-items.*', 'admin.products-image-gallery.*', 'admin.products-variants.*']) }}"><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
                    <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link" href="{{route('admin.seller-products.index')}}">Seller Products</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link" href="{{route('admin.seller-pending-products.index')}}">Seller Pending Products</a></li>
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sales</a></li>
                    <li class="{{ setActive(['admin.shipping-rules.*']) }}"><a class="nav-link" href="{{route('admin.shipping-rules.index')}}">Shipping Rules</a></li>
                    <li class="{{ setActive(['admin.vouchers.*']) }}"><a class="nav-link" href="{{route('admin.vouchers.index')}}">Vouchers</a></li>
                </ul>
            </li>



{{--            <li class="dropdown">--}}
{{--                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>--}}
{{--                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>--}}
{{--                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>--}}

        </ul>
    </aside>
</div>
