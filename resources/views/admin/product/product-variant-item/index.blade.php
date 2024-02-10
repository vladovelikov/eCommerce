@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items for {{$productVariant->name}}</h1>
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
                            <h4>All Product Variant Items</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.product-variant-items.create', ['variantId' => $productVariant->id])}}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{$dataTable->table()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ["type" => "module"]) }}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('body').on('click', '.change-status', function () {--}}
{{--                let isChecked = $(this).is(':checked');--}}
{{--                let id = $(this).data('id');--}}

{{--                $.ajax({--}}
{{--                    url: "{{route('admin.products-variants.update-status')}}",--}}
{{--                    method: 'PUT',--}}
{{--                    data: {--}}
{{--                        id: id,--}}
{{--                        status: isChecked--}}
{{--                    },--}}
{{--                    success: function(data) {--}}
{{--                        toastr.success(data.message);--}}
{{--                    },--}}
{{--                    error: function () {--}}
{{--                        toastr.error('Error while updating product variant status!');--}}
{{--                    }--}}
{{--                });--}}

{{--            })--}}
{{--        });--}}
{{--    </script>--}}
@endpush
