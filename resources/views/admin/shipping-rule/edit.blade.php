@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Update Shipping Rule</h1>
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
                            <h4>Update Shipping Rule</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.shipping-rules.update', $shippingRule->id)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$shippingRule->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select id="status" name="type" class="form-control shipping-type">
                                        <option {{$shippingRule->type == 'flat_cost' ? 'selected' : ''}} value="flat_cost">Flat Cost</option>
                                        <option {{$shippingRule->type == 'min_cost' ? 'selected' : ''}} value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>
                                <div class="form-group min-cost {{$shippingRule->type == 'min_cost' ? '' : 'd-none'}}">
                                    <label>Minimum Amount</label>
                                    <input type="text" name="min_cost" class="form-control" value="{{$shippingRule->min_cost}}">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" name="cost" class="form-control" value="{{$shippingRule->cost}}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{$shippingRule->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$shippingRule->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
