<div id="addProductSubCategoryModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Product Sub Category</h3>
            <span class="close-modal" data-modal-id="addProductSubCategoryModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Product Sub Category</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="AddProductSubCategoryForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="subCategory">Sub Category Name</label>
                                        <input type="text" name="subCategory" class="form-control" id="subCategory">
                                        <span class="text-danger error" id="subCategory_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text" name="category" class="form-control" id="category" autocomplete="off">
                                        <div id="category-list">
                                            <ul class="list-group">

                                            </ul>
                                        </div>
                                        {{-- <select name="category" class="form-control" id="category">
                                            <option value="">Category Name</option>
                                            @foreach ($inv_product_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <span class="text-danger error" id="category_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="addProductSubCategory" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
