$(document).ready(function () {

    /////////////// ------------------ Add Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addProductCategory', function (e) {
        e.preventDefault();
        let categoryName = $('#categoryName').val();
        $.ajax({
            url: "/admin/inventory/insertProductCategory",
            method: 'Post',
            data: { categoryName: categoryName },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addProductCategoryModal').hide();
                    $('#AddProductCategoryForm')[0].reset();
                    $('.category').load(location.href + ' .category');
                    toastr.success('Product Category Added Successfully', 'Added!');
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



    /////////////// ------------------ Edit Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editProductCategoryModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editProductCategory/${id}`,
            method: 'get',
            success: function (res) {
                $('#updateCategoryId').val(res.inv_product_category.id);
                $('#updateCategoryName').val(res.inv_product_category.product_category_name);

                // Create options dynamically based on the status value
                $('#updateStatus').html(`<option value="1" ${res.inv_product_category.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_product_category.status === 0 ? 'selected' : ''}>Inactive</option>`);
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



    /////////////// ------------------ Update Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateProductCategory', function (e) {
        e.preventDefault();
        let id = $('#updateCategoryId').val();
        let categoryName = $('#updateCategoryName').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateProductCategory/${id}`,
            method: 'Put',
            data: { categoryName: categoryName, status: status },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editProductCategoryModal').hide();
                    $('#EditProductCategoryForm')[0].reset();
                    $('.category').load(location.href + ' .category');
                    toastr.success('Product Category Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteProductCategory', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Product Category ??')) {
            $.ajax({
                url: `/admin/inventory/deleteProductCategory/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.category').load(location.href + ' .category');
                        toastr.success('Product Category Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/productCategory/pagination?page=${page}`,
            success: function (res) {
                $('.category').html(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchProductCategory`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.category').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.category').html(res.data);
                    $('.paginate').html(res.pagination);
                }
            }
        });
    });




    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/productCategory/searchPagination?page=${page}`,
            data:{search:search},
            success: function (res) {
                if (res.status == "null") {
                    $('.category').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.category').html(res.data);
                }
            }
        });
    });

});