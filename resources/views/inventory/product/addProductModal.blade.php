@section('style')
    <style>
        .modal-subject {
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" name="productName" class="form-control" id="productName">
                                        <span class="text-danger error" id="productName_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="manufacturer">Manufacturer:</label>
                                        <input type="text" name="manufacturer" class="form-control" id="manufacturer" autocomplete="off">
                                        <div id="manufacturer-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="manufacturer_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <input type="text" name="category" class="form-control" id="category" autocomplete="off">
                                        <div id="category-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="category_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="subCategorySelect">
                                        <label for="subCategory">Sub Category:</label>
                                        <input type="text" name="subCategory" class="form-control" id="subCategory" autocomplete="off">
                                        <div id="subCategory-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="subCategory_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" name="size" class="form-control" id="size">
                                        <span class="text-danger error" id="size_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unit">Unit:</label>
                                        <input type="text" name="unit" class="form-control" id="unit" autocomplete="off">
                                        <div id="unit-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="unit_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="mrp">
                                        <span class="text-danger error" id="mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cp">Cp</label>
                                        <input type="text" name="cp" class="form-control" id="cp">
                                        <span class="text-danger error" id="cp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">User id:</label>
                                        <select name="user" class="form-control" id="user">
                                            <option value="">User id</option>
                                            @foreach ($user_info as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
