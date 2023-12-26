@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Edit Suppliers</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.suppliers') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Edit Suppliers</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('update.suppliers',$inv_supplier->id) }}">
            @csrf 
            @method('Put')
            <div class="center">
                <div class="card-body">
                    <div class="form-group">
                        <label for="supplierName">Supplier Name</label>
                        <input type="text" name="supplierName" class="form-control" value="{{ $inv_supplier->sup_name }}"  id="supplierName">
                    </div>
                    <div class="form-group">
                        <label for="supplierEmail">Supplier Email</label>
                        <input type="text" name="supplierEmail" class="form-control" value="{{ $inv_supplier->sup_email }}"  id="supplierEmail">
                    </div>
                    
                    <div class="form-group">
                        <label for="supplierContact">Supplier Contact</label>
                        <input type="text" name="supplierContact" class="form-control" value="{{ $inv_supplier->sup_contact }}"  id="supplierContact">
                    </div>
                    <div class="form-group">
                        <label for="user">User id:</label>
                        <select name="user" class="form-control" id="user">
                            <option value="">User id</option>
                            @foreach($user_info as $user)
                                @if($user->id == $inv_supplier->user_id)
                                    <option value="{{ $user->id }}" selected> {{ $user->id }} </option>
                                @else
                                    <option value="{{ $user->id }}"> {{ $user->id }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Status</option>
                            @if($inv_supplier->status == 1)
                                <option value="1" selected> Active </option>
                                <option value="0"> Inactive </option>
                            @else
                                <option value="1"> Active </option>
                                <option value="0" selected> Inactive </option>
                            @endif
                        </select>
                    </div>
                    <div class="center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection