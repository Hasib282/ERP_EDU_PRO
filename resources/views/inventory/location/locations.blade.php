@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-3">
                        <button class="open-modal add" data-modal-id="addLocationModal">Add Location</button>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="search" id="search" class="form-control form-control-sm"placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body location">
            @include('inventory.location.locationPagination')
        </div>
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
