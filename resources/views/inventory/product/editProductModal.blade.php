@section('style')
    <style>
        .modal-subject {
            width: 65%;
        }
    </style>
@endsection



<div id="editProductModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Product</h3>
            <span class="close-modal" data-modal-id="editProductModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-11">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                </div>

                <form id="EditProductForm" method="post">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" class="form-control" id="id">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateProductName">Product Name</label>
                                        <input type="text" name="productName" class="form-control"
                                            id="updateProductName">
                                        <span class="text-danger error" id="update_productName_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateManufacturer">Manufacturer:</label>
                                        <select name="manufacturer" class="form-control" id="updateManufacturer">
                                            <option value="">Manufacturer</option>
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_manufacturer_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateCategory">Category:</label>
                                        <select name="category" class="form-control" id="updateCategory">
                                            <option value="">Category</option>
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_category_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="subCategorySelect">
                                        <label for="updateSubCategory">Sub Category:</label>
                                        <select name="subCategory" class="form-control" id="updateSubCategory" >
                                            <option value="">Sub Category</option>
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_subCategory_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateSize">Size</label>
                                        <input type="text" name="size" class="form-control" id="updateSize">
                                        <span class="text-danger error" id="update_size_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateUnit">Unit:</label>
                                        <select name="unit" class="form-control" id="updateUnit">
                                            <option value="">Unit</option>
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_unit_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateMrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="updateMrp">
                                        <span class="text-danger error" id="update_mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateUser">User id:</label>
                                        <select name="user" class="form-control" id="updateUser">
                                            <option value="">User id</option>
                                            {{-- options will be display dynamically --}}
                                        </select>
                                    </div>
                                    <span class="text-danger error" id="update_user_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateStatus">Status:</label>
                                        <select name="status" class="form-control" id="updateStatus">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_status_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateProduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
