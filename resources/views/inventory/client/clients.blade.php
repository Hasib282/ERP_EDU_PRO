@extends('admin.layouts/layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="title">
                <div class="row center">
                    <div class="col-md-2">
                        <button class="open-modal add" data-modal-id="addClientModal">Add Client</button>
                    </div>
                    <div class="col-md-10 text-right">
                        <input type="text" name="search" id="search" class="form-control form-control-sm"placeholder="Search here..." style="width: 40%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body client">
            @include('inventory.client.clientPagination')
        </div>
    </div>

    @include('inventory.client.addClientModal')

    @include('inventory.client.editClientModal')

    {!! Toastr::message() !!}
@endsection


{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/Inv_Client.js') }}"></script>
@endsection
