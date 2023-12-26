@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Add Suppliers</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.suppliers') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Add Suppliers</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" method="post" action="{{ route('insert.suppliers') }}">
            @csrf 
            <div class="center">
                <div class="card-body">
                    <div class="form-group">
                        <label for="supplierName">Supplier Name</label>
                        <input type="text" name="supplierName" class="form-control"  id="supplierName">
                        <span class="text-danger">
                            @error('supplierName')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="supplierEmail">Supplier Email</label>
                        <input type="text" name="supplierEmail" class="form-control"  id="supplierEmail">
                        <span class="text-danger">
                            @error('supplierEmail')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="supplierContact">Supplier Contact</label>
                        <input type="text" name="supplierContact" class="form-control"  id="supplierContact">
                        <span class="text-danger">
                            @error('supplierContact')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="user">User id:</label>
                        <select name="user" class="form-control" id="user">
                            <option value="">User id</option>
                        @foreach($user_info as $user)
                            <option value="{{ $user->id }}">{{ $user->id }}</option>
                        @endforeach
                        </select>
                        <span class="text-danger">
                            @error('user')
                                {{ $message }}
                            @enderror
                        </span>
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