@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Update Flash Sale</h1>
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
                            <h4>Create Flash Sale</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update', $flashSale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Products</label>
                                    <br>
                                    <select class="form-control product-select" name="products[]" multiple="multiple">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ in_array($product->id, $flashSale->products) ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $flashSale->name }}">
                                </div>
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label>Flash Sale Start Date</label>
                                            <input type="date" name="start_date" class="form-control datepicker"
                                                   value="{{ $flashSale->start_date }}">
                                        </div>
                                    </div>
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label>Flash Sale End Date</label>
                                            <input type="date" name="end_date" class="form-control datepicker"
                                                   value="{{ $flashSale->end_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Discount Percentage</label>
                                    <input type="number" min="0" name="discount_percentage" class="form-control" value="{{ $flashSale->discount_percentage }}">
                                </div>
                                <button type="submit" class="btn btn-primary ml-2">Update</button>
                            </form>

                            <div id="selected-products"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.product-select').select2({
                width: '600px'
            });
        });
    </script>
@endpush


