@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addProductCategoryModal">Add Product Category</button>
            </div>
            <div class="col-md-9">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="category">
        @include('inventory.product_category.productCategoryPagination')
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
