@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Add Units</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.units') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Add Units</h3>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('insert.units') }}">
            @csrf 
            <div class="center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="unitName">Unit Name</label>
                                <input type="text" name="unitName" class="form-control"  id="unitName">
                                <span class="text-danger">
                                    @error('unitName')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <button type="submit" id="addUnit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

{{-- @section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','#addUnit',function(e){
                e.preventDefault();
                let unitName = $('#unitName').val();
                // console.log(unitName)
                $.ajax({
                    url:"{{ route('insert.units') }}",
                    method:'post',
                    data:{unitName:unitName},
                    success:function(res){
                        console.log(res);
                    },
                    error:function(err) {
                        console.log(err.responseJSON.errors.unitName);
                    }
                });
            });
        });
    </script>
@endsection --}}