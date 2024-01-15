@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addReceiveDetailModal">Add Receive Details</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Supplier</option>
                    <option value="2">Invoice</option>
                    <option value="3">Batch</option>
                    <option value="4">Cp</option>
                    <option value="5">Discount</option>
                    <option value="6">Expiry Date</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="receive-detail">
        @include('inventory.receive_detail.receiveDetailPagination')
    </div>


    @include('inventory.receive_detail.addReceiveDetailModal')

    @include('inventory.receive_detail.editReceiveDetailModal')

    {!! Toastr::message() !!}
@endsection





{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Receive_Details.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
