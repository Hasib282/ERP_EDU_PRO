@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addProductModal">Add Product</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Name</option>
                    <option value="2">Category</option>
                    <option value="3">Sub Category</option>
                    <option value="4">Manufacturer</option>
                    <option value="5">Mrp</option>
                    <option value="6">Cp</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="product">
        @include('inventory.product.productPagination')
    </div>


    @include('inventory.product.addProductModal')
    @include('inventory.product.editProductModal')
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Product.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
