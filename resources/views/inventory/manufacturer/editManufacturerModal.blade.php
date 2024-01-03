{{-- @extends('admin.layouts/layout')
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

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Status</option>
                            @if($inv_manufacturer->status == 1)
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
@endsection --}}






{{-- @extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Add Manufacturers</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.manufacturers') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Add Manufacturers</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('insert.manufacturers') }}">
            @csrf 
            <div class="center">
                <div class="card-body">
                    <div class="form-group">
                        <label for="manufacturerName">Manufacturer Name</label>
                        <input type="text" name="manufacturerName" class="form-control"  id="manufacturerName">
                    </div>
                    <div class="form-group">
                        <label for="manufacturerEmail">Manufacturer Email</label>
                        <input type="text" name="manufacturerEmail" class="form-control"  id="manufacturerEmail">
                    </div>
                    
                    <div class="form-group">
                        <label for="manufacturerContact">Manufacturer Contact</label>
                        <input type="text" name="manufacturerContact" class="form-control"  id="manufacturerContact">
                    </div>
                    <div class="form-group">
                        <label for="user">User id:</label>
                        <select name="user" class="form-control" id="user">
                            <option value="">User id</option>
                        @foreach($user_info as $user)
                            <option value="{{ $user->id }}">{{ $user->id }}</option>
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
@endsection --}}




<div id="editManufacturerModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Manufacturer</h3>
            <span class="close-modal" data-modal-id="editManufacturerModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Manufacturer</h3>
                    </div>
                </div>

                <form id="EditManufacturerForm" method="post">
                    @csrf 
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control"  id="id">
                            <div class="form-group">
                                <label for="updateManufacturerName">Manufacturer Name</label>
                                <input type="text" name="manufacturerName" class="form-control"  id="updateManufacturerName">
                                <span class="text-danger error" id="update_manufacturerName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateManufacturerEmail">Manufacturer Email</label>
                                <input type="text" name="manufacturerEmail" class="form-control"  id="updateManufacturerEmail">
                                <span class="text-danger error" id="update_manufacturerEmail_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="updateManufacturerContact">Manufacturer Contact</label>
                                <input type="text" name="manufacturerContact" class="form-control"  id="updateManufacturerContact">
                                <span class="text-danger error" id="update_manufacturerContact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateUser">User id:</label>
                                <select name="user" class="form-control" id="updateUser">
                                    <option value="">User id</option>
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_user_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    <option value="">Status</option>
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateManufacturer" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

