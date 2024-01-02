@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-3">
                        <button class="open-modal add" data-modal-id="addProductModal">Add Product</button>
                    </div>
                    <div class="col-md-9 text-right">
                        <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body product">
            @include('inventory.product.productPagination')
        </div>
    </div>

    @include('inventory.product.addProductModal') 
    @include('inventory.product.editProductModal') 
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Product.js') }}"></script>
@endsection
