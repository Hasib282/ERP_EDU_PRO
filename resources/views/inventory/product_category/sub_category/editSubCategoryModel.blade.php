{{-- @extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Edit Sub Category</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.subCatagory') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Edit Sub Category</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('update.subCatagory',$inv_sub_category->id) }}">
            @csrf 
            @method('Put')
            <div class="center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subCategory">Sub Category</label>
                                <input type="text" name="subCategory" class="form-control" value="{{ $inv_sub_category->sub_category_name }}"  id="subCategory">
                            </div>
                            
                            <div class="form-group">
                                <label for="category">Category Name</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="">Category Name</option>
                                    @foreach($inv_product_category as $category)
                                        @if($category->id == $inv_sub_category->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->product_category_name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">Status</option>
                                    @if($inv_sub_category->status == 1)
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
        <p>Add Product Category</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.productCatagory') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-5">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Edit Product Category</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('update.productCatagory',$inv_product_category->id) }}">
            @csrf 
            @method('Put')
            <div class="center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" name="categoryName" class="form-control"  id="categoryName" value="{{ $inv_product_category->product_category_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Status</option>
                            @if($inv_product_category->status == 1)
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









<div id="editProductSubCategoryModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Product Sub Category</h3>
            <span class="close-modal" data-modal-id="editProductSubCategoryModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Product Sub Category</h3>
                    </div>
                </div>

                <form id="EditProductSubCategoryForm" method="post">
                    @csrf 
                    @method('Put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" class="form-control"  id="updateSubCategoryId">
                                    <div class="form-group">
                                        <label for="updateSubCategoryName">Category Name</label>
                                        <input type="text" name="subCategory" class="form-control"  id="updateSubCategoryName">
                                        <span class="text-danger" id="update_subCategory_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="updateCategory">Category:</label>
                                <select name="category" class="form-control" id="updateCategory">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger" id="update_category_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateStatus">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger" id="update_status_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateProductSubCategory" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>