@extends('admin.layouts/layout')
@section('content')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTempTransactionModal">Add Temp Transactions</button>
            </div>
            <div class="col-md-9 search">
                {{-- <select name="searchOption" id="searchOption" class="select">
                    <option value="1">Name</option>
                    <option value="2">Email</option>
                    <option value="3">Contact</option>
                    <option value="4">Address</option>
                </select> --}}
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here..."
                    style="width: 40%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="transaction_temp">
        @include('inventory.transaction.details_temp.tempDetailsPagination')
    </div>


    @include('inventory.transaction.details_temp.addTempDetailModal')
    @include('inventory.transaction.details_temp.editTempDetailModal')
@endsection

{{-- ajax part start from here --}}
@section('ajax')
    {{-- <script src="{{ asset('js/ajax/Inv_Supplier.js') }}"></script> --}}
    <script src="{{ asset('js/ajax/toggle_status.js') }}"></script>
@endsection
