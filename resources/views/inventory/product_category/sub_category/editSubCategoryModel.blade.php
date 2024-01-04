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
                                        <span class="text-danger error" id="update_subCategory_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="updateCategory">Category:</label>
                                <select name="category" class="form-control" id="updateCategory">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_category_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateStatus">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
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