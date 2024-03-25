@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Shipping Rule</h1>
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
                            <h4>Create Shipping Rule</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.shipping-rules.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select id="status" name="type" class="form-control shipping-type">
                                        <option value="flat_cost">Flat Cost</option>
                                        <option value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>
                                <div class="form-group min-cost d-none">
                                    <label>Minimum Amount</label>
                                    <input type="text" name="min_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" name="cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
           $('body').on('change', '.shipping-type', function() {
               let shippingType = $(this).val();

               if (shippingType !== 'min_cost') {
                   $('.min-cost').addClass('d-none');
               } else {
                   $('.min-cost').removeClass('d-none');
               }
           });
        });
    </script>
@endpush
