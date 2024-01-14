@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addStoreModal">Add Store</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Name</option>
                    <option value="2">Location</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="store">
        @include('inventory.store.storePagination')
    </div>


    @include('inventory.store.addStoreModal')

    @include('inventory.store.editStoreModal')

    {!! Toastr::message() !!}
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Store.js') }}"></script>
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
