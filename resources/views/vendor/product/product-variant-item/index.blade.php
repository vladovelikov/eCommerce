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
                        <h3><i class="far fa-user"></i> Variant items for {{$product->name}}</h3>
                        <div class="create_button">
                            <a href="{{route('vendor.product-variant-items.create', ['productId' => $product->id, 'variantId' => $productVariant->id])}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{$dataTable->table()}}
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
    {{ $dataTable->scripts(attributes: ["type" => "module"]) }}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function () {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('vendor.product-variant-items.update-status')}}",
                    method: 'PUT',
                    data: {
                        id: id,
                        status: isChecked
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function () {
                        toastr.error('Error while updating product variant status!');
                    }
                });

            })
        });
    </script>
@endpush
