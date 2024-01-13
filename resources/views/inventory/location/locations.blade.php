@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addLocationModal">Add Location</button>
            </div>
            <div class="col-md-9 search">
                <select name="search-option" id="search-option" class="select">
                    <option value="1">Division</option>
                    <option value="2">District</option>
                    <option value="3">City</option>
                    <option value="4">Area</option>
                    <option value="5">Road No</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="location">
        @include('inventory.location.locationPagination')
    </div>


    @include('inventory.location.addLocationModal')

    @include('inventory.location.editLocationModal')

    {!! Toastr::message() !!}
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Location.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
