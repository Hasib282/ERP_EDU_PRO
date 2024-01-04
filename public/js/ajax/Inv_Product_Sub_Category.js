$(document).ready(function () {

    /////////////// ------------------ Add Product Sub Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addProductSubCategory', function (e) {
        e.preventDefault();
        let subCategory = $('#subCategory').val();
        let category = $('#category').val();
        $.ajax({
            url: "/admin/inventory/insertProductSubCategory",
            method: 'Post',
            data: { subCategory: subCategory,category:category },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addProductSubCategoryModal').hide();
                    $('#AddProductSubCategoryForm')[0].reset();
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
                $.each(res.inv_product_category, function(key,category) {
                    $('#updateCategory').append(`<option value="${category.id}" ${res.sub_category.category_id === category.id ? 'selected' : ''}>${category.product_category_name}</option>`);
                });

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
        let category = $('#updateCategory').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateProductSubCategory/${id}`,
            method: 'Put',
            data: { subCategory: subCategory,category:category, status: status },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editProductSubCategoryModal').hide();
                    $('#EditProductSubCategoryForm')[0].reset();
                    $('.sub-category').load(location.href + ' .sub-category');
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
                        toastr.success('Product Sub Category Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination Sub ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/productSubCategory/pagination?page=${page}`,
            success: function (res) {
                $('.sub-category').html(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchProductSubCategory`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.sub-category').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.sub-category').html(res.data);
                    $('.paginate').html(res.pagination);
                }
            }
        });
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/subCategory/searchPagination?page=${page}`,
            data:{search:search},
            success: function (res) {
                if (res.status == "null") {
                    $('.sub-category').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.sub-category').html('')
                    $('.sub-category').html(res.data);
                }
            }
        });
    });

});