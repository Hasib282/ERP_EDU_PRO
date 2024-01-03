@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-3">
                        <button class="open-modal add" data-modal-id="addManufacturerModal">Add Manufacture</button>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body manufacturer">
            @include('inventory.manufacturer.manufacturerPagination')
        </div>
    </div>

    @include('inventory.manufacturer.addManufacturerModal')
    @include('inventory.manufacturer.editManufacturerModal')
@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Manufacturer.js') }}"></script>
@endsection
