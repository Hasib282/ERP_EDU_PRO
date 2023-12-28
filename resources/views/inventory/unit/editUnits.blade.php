@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Edit Units</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.units') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Edit Units</h3>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('update.units',$inv_unit->id) }}">
            @csrf 
            @method('Put')
            <div class="center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="unitName">Unit Name</label>
                                <input type="text" name="unitName" class="form-control" value="{{ $inv_unit->unit_name }}"  id="unitName">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Status</option>
                            @if($inv_unit->status == 1)
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