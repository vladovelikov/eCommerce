@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Seller Products</h1>
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
                            <h4>All Seller Products</h4>
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function () {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.product.update-status')}}",
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

            $('body').on('change', '.is_approved', function () {
                let isApproved = $(this).val();
                let productId = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.update-approval-status')}}",
                    method: 'PUT',
                    data: {
                        productId: productId,
                        isApproved: isApproved
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success(data.message);
                        window.location.reload();
                    },
                    error: function () {
                        toastr.error('Error while updating product variant status!');
                    }
                });

            })
        });
    </script>
@endpush
