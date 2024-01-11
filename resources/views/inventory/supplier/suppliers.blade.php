@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-3">
                        <button class="open-modal add" data-modal-id="addSupplierModal">Add Supplier</button>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body supplier">
            @include('inventory.supplier.supplierPagination')
        </div>
    </div>

    @include('inventory.supplier.addSupplierModal')
    @include('inventory.supplier.editSupplierModal')
@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Supplier.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection

