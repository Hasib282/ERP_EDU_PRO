@extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Edit Products</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.products') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-11">
        <div class="card-header center">
            <h3 class="card-title">Edit Products</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="center" method="post" action="{{ route('update.products',$inv_product->id) }}">
            @csrf 
            @method('Put')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" name="productName" class="form-control"  id="productName" value="{{ $inv_product->product_name }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" class="form-control" id="category">
                                <option value="">------Select category-------</option>
                                @foreach($inv_product_category as $category)
                                    @if($category->id == $inv_product->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->product_category_name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="manufacturer">Manufacturer:</label>
                            <select name="manufacturer" class="form-control" id="manufacturer">
                                <option value="">------Select manufacturer-------</option>
                                @foreach($inv_manufacturer as $manufacturer)
                                    @if($manufacturer->id == $inv_product->manufacturer_id)
                                        <option value="{{ $manufacturer->id }}" selected>{{ $manufacturer->manufacturer_name }}</option>
                                    @else
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->manufacturer_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subCategory">Sub Category:</label>
                            <select name="subCategory" class="form-control" id="subCategory">
                                <option value="">------Select category-------</option>
                                @foreach($sub_category as $subcategory)
                                    @if($subcategory->id == $inv_product->sub_category_id)
                                        <option value="{{ $subcategory->id }}" selected>{{ $subcategory->sub_category_name }}</option>
                                    @else
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="size">size</label>
                            <input type="text" name="size" class="form-control" value="{{ $inv_product->size }}" id="size">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <select name="unit" class="form-control" id="unit">
                                <option value="">unit</option>
                                @foreach($inv_unit as $unit)
                                    @if($unit->id == $inv_product->unit)
                                        <option value="{{ $unit->id }}" selected>{{ $unit->unit_name }}</option>
                                    @else
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mrp">MRP</label>
                            <input type="text" name="mrp" class="form-control" value="{{ $inv_product->mrp }}" id="mrp">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user">Select user id:</label>
                            <select name="user" class="form-control" id="user">
                                <option value="">------Select user id -------</option>
                            @foreach($user_info as $user)
                                @if($user->id == $inv_product->user_id)
                                    <option value="{{ $user->id }}" selected>{{ $user->id }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->id }}</option>
                                @endif
                                <option value="{{ $user->id }}">{{ $user->id }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="status">
                                <option value="">Status</option>
                                @if($inv_product->status == 1)
                                    <option value="1" selected> Active </option>
                                    <option value="0"> Inactive </option>
                                @else
                                    <option value="1"> Active </option>
                                    <option value="0" selected> Inactive </option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                
            </div>
        </form>
    </div>
</div>

@endsection