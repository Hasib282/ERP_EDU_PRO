@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-4">
                        <button class="open-modal add" data-modal-id="addReceiveDetailModal">Add Receive Details</button>
                    </div>
                    <div class="col-md-8 text-right">
                        <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body receive-detail">
            @include('inventory.receive_detail.receiveDetailPagination')
        </div>
    </div>

    @include('inventory.receive_detail.addReceiveDetailModal')

    @include('inventory.receive_detail.editReceiveDetailModal')

    {!! Toastr::message() !!}
@endsection





{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Receive_Details.js') }}"></script>
@endsection
