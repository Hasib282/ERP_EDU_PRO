@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Edit Manufacturers</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.manufacturers') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Edit Manufacturers</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('update.manufacturers',$inv_manufacturer->id) }}">
            @csrf 
            @method('Put')
            <div class="center">
                <div class="card-body">
                    <div class="form-group">
                        <label for="manufacturerName">Manufacturer Name</label>
                        <input type="text" name="manufacturerName" class="form-control" value="{{ $inv_manufacturer->manufacturer_name }}"  id="manufacturerName">
                    </div>
                    <div class="form-group">
                        <label for="manufacturerEmail">Manufacturer Email</label>
                        <input type="text" name="manufacturerEmail" class="form-control" value="{{ $inv_manufacturer->manufacturer_email }}"  id="manufacturerEmail">
                    </div>
                    
                    <div class="form-group">
                        <label for="manufacturerContact">Manufacturer Contact</label>
                        <input type="text" name="manufacturerContact" class="form-control" value="{{ $inv_manufacturer->manufacturer_contact }}"  id="manufacturerContact">
                    </div>
                    <div class="form-group">
                        <label for="user">User id:</label>
                        <select name="user" class="form-control" id="user">
                            <option value="">User id</option>
                            @foreach($user_info as $user)
                                @if($user->id == $inv_manufacturer->user_id)
                                    <option value="{{ $user->id }}" selected> {{ $user->id }} </option>
                                @else
                                    <option value="{{ $user->id }}"> {{ $user->id }} </option>
                                @endif
                            @endforeach
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