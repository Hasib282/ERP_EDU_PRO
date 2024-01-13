@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addUnitModal">Add Unit</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here..." style="width: 40%;">
            </div>
        </div>
    </div>

    <!-- table show -->
    <div class="unit">
        @include('inventory.unit.UnitPagination')
    </div>

    @include('inventory.unit.addUnitModal')

    @include('inventory.unit.editUnitModal')

    {!! Toastr::message() !!}
@endsection



{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Unit.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
