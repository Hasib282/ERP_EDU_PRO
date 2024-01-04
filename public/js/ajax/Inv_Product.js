$(document).ready(function () {

    /////////////// ------------------ Add Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addProduct', function (e) {
        e.preventDefault();
        let productName = $('#productName').val();
        let manufacturer = $('#manufacturer').val();
        let category = $('#category').val();
        let subCategory = $('#subCategory').val();
        let size = $('#size').val();
        let unit = $('#unit').val();
        let mrp = $('#mrp').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertProducts",
            method: 'Post',
            data: { productName: productName, manufacturer:manufacturer, category:category, subCategory:subCategory, size:size, unit:unit, mrp:mrp, user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addProductModal').hide();
                    $('#AddProductForm')[0].reset();
                    $('.product').load(location.href + ' .product');
                    toastr.success('Product Added Successfully', 'Added!');
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



    /////////////// ------------------ Edit Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editProductModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editProducts/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_product.id);

                $('#updateProductName').val(res.inv_product.product_name);

                $.each(res.inv_manufacturer, function(key,manufacturer) {
                    $('#updateManufacturer').append(`<option value="${manufacturer.id}" ${res.inv_product.manufacturer_id === manufacturer.id ? 'selected' : ''}>${manufacturer.manufacturer_name}</option>`);
                });

                $.each(res.inv_product_category, function(key,category) {
                    $('#updateCategory').append(`<option value="${category.id}" ${res.inv_product.category_id === category.id ? 'selected' : ''}>${category.product_category_name}</option>`);
                });

                $.each(res.sub_category, function(key,subCategory) {
                    $('#updateSubCategory').append(`<option value="${subCategory.id}" ${res.inv_product.sub_category_id === subCategory.id ? 'selected' : ''}>${subCategory.sub_category_name}</option>`);
                });

                $('#updateSize').val(res.inv_product.size);

                $.each(res.inv_unit, function(key,unit) {
                    $('#updateUnit').append(`<option value="${unit.id}" ${res.inv_product.unit === unit.id ? 'selected' : ''}>${unit.unit_name}</option>`);
                });

                $('#updateMrp').val(res.inv_product.mrp);

                $.each(res.user_info, function(key,user) {
                    $('#updateUser').append(`<option value="${user.id}" ${res.inv_product.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });
                
                // Create options dynamically based on the status value
                $('#updateStatus').html(`<option value="1" ${res.inv_product.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_product.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
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



    /////////////// ------------------ Update Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateProduct', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let productName = $('#updateProductName').val();
        let manufacturer = $('#updateManufacturer').val();
        let category = $('#updateCategory').val();
        let subCategory = $('#updateSubCategory').val();
        let size = $('#updateSize').val();
        let unit = $('#updateUnit').val();
        let mrp = $('#updateMrp').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateProducts/${id}`,
            method: 'Put',
            data: { productName: productName,manufacturer:manufacturer,category:category,subCategory:subCategory,size:size,unit:unit,mrp:mrp,user:user, status: status },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editProductModal').hide();
                    $('#EditProductForm')[0].reset();
                    $('.product').load(location.href + ' .product');
                    toastr.success('Product Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteProduct', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Product??')) {
            $.ajax({
                url: `/admin/inventory/deleteProducts/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.product').load(location.href + ' .product');
                        toastr.success('Product Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadProductData(`/admin/inventory/product/pagination?page=${page}`, {}, '.product');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadProductData(`/admin/inventory/searchProducts`, {search:search}, '.product');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadProductData(`/admin/inventory/product/searchPagination?page=${page}`, {search:search}, '.product');
    });


    //product pagination data load function
    function loadProductData(url, data, targetElement) {
        $.ajax({
            url: url,
            data: data,
            success: function (res) {
                if (res.status == "null") {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                } else {
                    $(targetElement).html(res.data);
                }
            }
        });
    }

});