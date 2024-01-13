@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addSupplierModal">Add Supplier</button>
            </div>
            <div class="col-md-9 search">
                <select name="search-option" id="search-option" class="select">
                    <option value="1">Name</option>
                    <option value="2">Email</option>
                    <option value="3">Contact</option>
                    <option value="4">Address</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here..."
                    style="width: 40%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="supplier">
        @include('inventory.supplier.supplierPagination')
    </div>


    @include('inventory.supplier.addSupplierModal')
    @include('inventory.supplier.editSupplierModal')
@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Supplier.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
