@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-3">
                        <button class="open-modal add" data-modal-id="addSupplierModal">Add Supplier</button>
                    </div>
                    <div class="col-md-9 text-right">
                        <input type="text" name="searchSupplier" id="searchSupplier" class="form-control form-control-sm" placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body inv-supplier">
            @include('inventory.supplier.supplierPagination');
        </div>
    </div>


    @include('inventory.supplier.addSupplierModal');

    @include('inventory.supplier.editSupplierModal');

    {!! Toastr::message() !!}
@endsection




{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Supplier.js') }}"></script>
@endsection
