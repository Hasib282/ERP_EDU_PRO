@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-4">
                        <button class="open-modal add" data-modal-id="addProductCategoryModal">Add Product Category</button>
                    </div>
                    <div class="col-md-8 text-right">
                        <input type="text" name="search" id="search" class="form-control form-control-sm"
                            placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body category">
            @include('inventory.product_category.productCategoryPagination')
        </div>
    </div>

    @include('inventory.product_category.addProductCategoryModal')

    @include('inventory.product_category.editProductCategoryModal')

    {!! Toastr::message() !!}
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Product_Category.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
