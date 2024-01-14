$(document).ready(function () {

    /////////////// ------------------ Add Product Sub Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addProductSubCategory', function (e) {
        e.preventDefault();
        let subCategory = $('#subCategory').val();
        let category = $('#category').attr('data-id');
        $.ajax({
            url: "/admin/inventory/insertProductSubCategory",
            method: 'Post',
            data: { subCategory: subCategory,category:category },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addProductSubCategoryModal').hide();
                    $('#AddProductSubCategoryForm')[0].reset();
                    $('#category').removeAttr('data-id');
                    $('#search').val('');
                    $('.sub-category').load(location.href+' .sub-category');
                    toastr.success('Product Sub Category Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                console.log(err)
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    /////////////// ------------------ Edit Product Sub Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editProductSubCategoryModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editProductSubCategory/${id}`,
            method: 'get',
            success: function (res) {
                $('#updateSubCategoryId').val(res.sub_category.id);
                $('#updateSubCategoryName').val(res.sub_category.sub_category_name);

                getCategoryById(res.sub_category.category_id,'#updateCategory');
                $('#updateCategory').attr('data-id',res.sub_category.category_id);

                // Create options dynamically based on the status value
                $('#updateStatus').html(`<option value="1" ${res.sub_category.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.sub_category.status === 0 ? 'selected' : ''}>Inactive</option>`);
                var modal = document.getElementById(modalId);

                if (modal) {
                    modal.style.display = 'block';
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Product Sub Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateProductSubCategory', function (e) {
        e.preventDefault();
        let id = $('#updateSubCategoryId').val();
        let subCategory = $('#updateSubCategoryName').val();
        let category = $('#updateCategory').attr('data-id');
        let status = $('#updateStatus').val();
        alert(id+"sub"+subCategory+"cat"+category+"status"+status)
        alert()
        $.ajax({
            url: `/admin/inventory/updateProductSubCategory/${id}`,
            method: 'Put',
            data: { subCategory: subCategory, category:category, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editProductSubCategoryModal').hide();
                    $('#EditProductSubCategoryForm')[0].reset();
                    $('.sub-category').load(location.href + ' .sub-category');
                    $('#search').val('');
                    $('#updateCategory').removeAttr('data-id');
                    toastr.success('Product Sub Category Updated Successfully', 'Updated!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#update_' + key + "_error").text(value);
                })
            }
        });
    });



    /////////////// ------------------ Delete Product Sub Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteProductSubCategory', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Product sub Category ??\n If you delete it all the products related to this will be deleted.')) {
            $.ajax({
                url: `/admin/inventory/deleteProductSubCategory/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.sub-category').load(location.href + ' .sub-category');
                        $('#search').val('');
                        toastr.success('Product Sub Category Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });

    

    /////////////// ------------------ Pagination Sub ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadProductSubCategoryData(`/admin/inventory/productSubCategory/pagination?page=${page}`, {}, '.sub-category');
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });
    

    //////////////////////////// ------------------ Search part ajax start ---------------- /////////////////////////////
    //search main mechanism
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadProductSubCategoryData(`/admin/inventory/searchProductSubCategory/name`, {search:search, searchOption:searchOption}, '.sub-category');
        }
        else if(searchOption == "2"){
            loadProductSubCategoryData(`/admin/inventory/productSubCategory/categoryName`, {search:search}, '.sub-category');
        }
    });


    //Search Pagination ajax part
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadProductSubCategoryData(`/admin/inventory/productSubCategory/namePagination?page=${page}`, {search:search}, '.sub-category');
        }
        else if(searchOption == "2"){
            loadProductSubCategoryData(`/admin/inventory/productSubCategory/categoryNamePagination?page=${page}`, {search:search}, '.sub-category');
        }
    });



    //product Sub Category data load function
    function loadProductSubCategoryData(url, data, targetElement) {
        $.ajax({
            url: url,
            data: data,
            success: function (res) {
                if (res.status == "null") {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                } else {
                    $(targetElement).html(res.data);
                    if(res.paginate){
                        $(targetElement).append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
            }
        });
    }


    //search category by id
    function getCategoryById(id, targetElement1) {
        if(id==""){
            $(targetElement1).val('');
        }
        else{
            $.ajax({
                url: `/admin/inventory/getCategoryById/${id}`,
                method: 'get',
                success: function (res) {
                    if (res.status == "success") {
                        $(targetElement1).val(res.inv_category.product_category_name);
                    }
                }
            });
        }
    }

    ///////////////////////// ------------------ Search part ajax end ---------------- /////////////////////////////////
});