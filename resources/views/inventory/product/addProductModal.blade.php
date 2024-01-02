{{-- @extends('admin.layouts/layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="heading">
    <div class="title">
        <p>Add Products</p>
    </div>
    <div class="create-new">
        <a href="{{ route('show.products') }}"><button class="back"><- Back</button></a>
    </div>
</div>
<div class="center">
    <div class="card card-primary col-sm-11">
        <div class="card-header">
            <div class="center">
                <h3 class="card-title">Add Products</h3>
            </div>
            
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="myForm" class="" method="post" action="{{ route('insert.products') }}">
            @csrf 
            <div class="center">
                <div class="card-body">
    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" name="productName" class="form-control"  id="productName">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" id="category">
                                    <option>Category</option>
                                    @foreach ($inv_product_category as $category)
                                        <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" id="subCategorySelect">
                                <label for="subCategory">Sub Category:</label>
                                <select name="subCategory" class="form-control" id="subCategory">
                                    <option value="">Sub Category</option>
                                    @foreach ($sub_category as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer:</label>
                                <select name="manufacturer" class="form-control" id="manufacturer">
                                    <option value="">Manufacturer</option>
                                    @foreach ($inv_manufacturer as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->manufacturer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="text" name="size" class="form-control" id="size">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unit">Unit:</label>
                                <select name="unit" class="form-control" id="unit">
                                    <option value="">Unit</option>
                                    @foreach ($inv_unit as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="text" name="mrp" class="form-control"  id="mrp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user">User id:</label>
                                <select name="user" class="form-control" id="user">
                                    <option value="">User id</option>
                                @foreach ($user_info as $user)
                                    <option value="{{ $user->id }}">{{ $user->id }}</option>
                                @endforeach
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
</div> --}}

{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        $('#subCategorySelect').hide();
        $('#subCategory').hide();
        jQuery('#category').change(function() {
            var selectedCategory = jQuery(this).val();
            if (selectedCategory) {
            $.ajax({
                url: '{{ route('get.subCategory') }}',
                type: 'GET',
                data: { category_id: selectedCategory },
                success: function(response) {
                    $('#subCategory').show();
                    $('#subCategory').empty();
                    $.each(response, function(key, subcategory) {
                        $('#subCategory').append('<option value="' + subcategory.id + '">' + subcategory.sub_category_name + '</option>');
                    });
                },
                error: function(err) {
                    console.error(err);
                }
            });
        } else {
            $('#subCategory').hide();
            $('#subCategory').empty();
        }
        //     alert(selectedCategory);
        //     jQuery.ajax({
        //         url:'/admin/inventory/getSubCategory/'.selectedCategory,
        //         type:'GET',
        //         success:function(data){
        //             // $.each(data, function(key, value) {
        //             //     $('#subCategory').append('<option value="' + key + '">' + value + '</option>');
        //             // });
        //             // Show the subcategory field
        //             $('#subCategorySelect').show();
        //             $('#subCategory').show();
        //             alert(data)
        //         }
        // })
        });
        

    })

    
</script> --}}

{{-- @endsection --}}


@section('style')
    <style>
        .modal-subject{
            width: 65%;
        }
    </style>
@endsection



<div id="addProductModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Product</h3>
            <span class="close-modal" data-modal-id="addProductModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-11">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                </div>

                <form id="AddProductForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" name="productName" class="form-control" id="productName">
                                        <span class="text-danger error" id="productName_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="manufacturer">Manufacturer:</label>
                                        <select name="manufacturer" class="form-control" id="manufacturer">
                                            <option value="">Manufacturer</option>
                                            @foreach ($inv_manufacturer as $manufacturer)
                                                <option value="{{ $manufacturer->id }}">
                                                    {{ $manufacturer->manufacturer_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="manufacturer_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <select name="category" class="form-control" id="category">
                                            <option value="">Category</option>
                                            @foreach ($inv_product_category as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->product_category_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="category_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="subCategorySelect">
                                        <label for="subCategory">Sub Category:</label>
                                        <select name="subCategory" class="form-control" id="subCategory">
                                            <option value="">Sub Category</option>
                                            @foreach ($sub_category as $subCategory)
                                                <option value="{{ $subCategory->id }}">
                                                    {{ $subCategory->sub_category_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="subCategory_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" name="size" class="form-control" id="size">
                                        <span class="text-danger error" id="size_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit">Unit:</label>
                                        <select name="unit" class="form-control" id="unit">
                                            <option value="">Unit</option>
                                            @foreach ($inv_unit as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="unit_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="mrp">
                                        <span class="text-danger error" id="mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">User id:</label>
                                        <select name="user" class="form-control" id="user">
                                            <option value="">User id</option>
                                            @foreach ($user_info as $user)
                                                <option value="{{ $user->id }}">{{ $user->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger error" id="user_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="addProduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
