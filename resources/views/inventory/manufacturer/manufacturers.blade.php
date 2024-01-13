@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addManufacturerModal">Add Manufacture</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Name</option>
                    <option value="2">Email</option>
                    <option value="3">Contact</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>

    <!-- table show -->
    <div class="manufacturer">
        @include('inventory.manufacturer.manufacturerPagination')
    </div>

    @include('inventory.manufacturer.addManufacturerModal')
    @include('inventory.manufacturer.editManufacturerModal')
@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Manufacturer.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
