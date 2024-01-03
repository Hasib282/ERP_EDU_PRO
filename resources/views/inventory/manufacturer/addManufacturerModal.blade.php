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




<div id="addManufacturerModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Manufacturer</h3>
            <span class="close-modal" data-modal-id="addManufacturerModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Manufacturer</h3>
                    </div>
                </div>

                <form id="AddManufacturerForm" method="post">
                    @csrf 
                    <div class="center">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="manufacturerName">Manufacturer Name</label>
                                <input type="text" name="manufacturerName" class="form-control"  id="manufacturerName">
                                <span class="text-danger error" id="manufacturerName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="manufacturerEmail">Manufacturer Email</label>
                                <input type="text" name="manufacturerEmail" class="form-control"  id="manufacturerEmail">
                                <span class="text-danger error" id="manufacturerEmail_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="manufacturerContact">Manufacturer Contact</label>
                                <input type="text" name="manufacturerContact" class="form-control"  id="manufacturerContact">
                                <span class="text-danger error" id="manufacturerContact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="user">User id:</label>
                                <select name="user" class="form-control" id="user">
                                    <option value="">User id</option>
                                @foreach($user_info as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>
                                <span class="text-danger error" id="user_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="addManufacturer" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

