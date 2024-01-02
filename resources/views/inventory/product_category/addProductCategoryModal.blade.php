<div id="addProductCategoryModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Product Category</h3>
            <span class="close-modal" data-modal-id="addProductCategoryModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Product Category</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="AddProductCategoryForm" method="POST">
                    @csrf 
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="categoryName" class="form-control"  id="categoryName">
                                        <span class="text-danger error" id="categoryName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="addProductCategory">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
