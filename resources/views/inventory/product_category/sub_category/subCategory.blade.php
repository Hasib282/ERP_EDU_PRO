@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-4">
                        <button class="open-modal add" data-modal-id="addProductSubCategoryModal">Add Sub Category</button>
                    </div>
                    <div class="col-md-8 text-right">
                        <input type="text" name="search" id="search" class="form-control form-control-sm"
                            placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body sub-category">
            @include('inventory.product_category.sub_category.subCategoryPagination')
        </div>
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