@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addProductSubCategoryModal">Add Sub Category</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Sub Category</option>
                    <option value="2">Category</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="sub-category">
        @include('inventory.product_category.sub_category.subCategoryPagination')
    </div>


    @include('inventory.product_category.sub_category.addSubCategoryModel')

    @include('inventory.product_category.sub_category.editSubCategoryModel')
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Product_Sub_Category.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
