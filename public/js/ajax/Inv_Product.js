$(document).ready(function () {
    
    /////////////// ------------------ Add Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addProduct', function (e) {
        e.preventDefault();
        let productName = $('#productName').val();
        let manufacturer = $('#manufacturer').attr('data-id');
        let category = $('#category').attr('data-id');
        let subCategory = $('#subCategory').attr('data-id');
        let size = $('#size').val();
        let unit = $('#unit').attr('data-id');
        let mrp = $('#mrp').val();
        let expiry = $('#expiry').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertProducts",
            method: 'Post',
            data: { productName: productName, manufacturer: manufacturer, category: category, subCategory: subCategory, size: size, unit: unit, mrp: mrp, expiry: expiry, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addProductModal').hide();
                    $('#AddProductForm')[0].reset();
                    $('#manufacturer').removeAttr('data-id');
                    $('#category').removeAttr('data-id');
                    $('#subCategory').removeAttr('data-id');
                    $('#unit').removeAttr('data-id');
                    $('#search').val('');
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

                getById('/admin/inventory/getManufacturerById', res.inv_product.manufacturer_id, 'inv_manufacturer', 'manufacturer_name', '#updateManufacturer');
                $('#updateManufacturer').attr('data-id',res.inv_product.manufacturer_id);
                

                getById('/admin/inventory/getCategoryById', res.inv_product.category_id, 'inv_category', 'product_category_name', '#updateCategory');
                $('#updateCategory').attr('data-id',res.inv_product.category_id);

                getById('/admin/inventory/getSubCategoryById', res.inv_product.sub_category_id, 'sub_category', 'sub_category_name', '#updateSubCategory');
                $('#updateSubCategory').attr('data-id',res.inv_product.sub_category_id);

                $('#updateSize').val(res.inv_product.size);


                getById('/admin/inventory/getUnitById', res.inv_product.unit, 'inv_unit', 'unit_name', '#updateUnit');
                $('#updateUnit').attr('data-id',res.inv_product.unit);

                $('#updateMrp').val(res.inv_product.mrp);
                $('#updateExpiry').val(res.inv_product.expiry_date);


                $('#updateUser').html('');
                $('#updateUser').append(`<option value="" >User</option>`);
                $.each(res.user_info, function (key, user) {
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
        let manufacturer = $('#updateManufacturer').attr('data-id');
        let category = $('#updateCategory').attr('data-id');
        let subCategory = $('#updateSubCategory').attr('data-id');
        let size = $('#updateSize').val();
        let unit = $('#updateUnit').attr('data-id');
        let mrp = $('#updateMrp').val();
        let expiry = $('#updateExpiry').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateProducts/${id}`,
            method: 'Put',
            data: { productName: productName, manufacturer: manufacturer, category: category, subCategory: subCategory, size: size, unit: unit, mrp: mrp, expiry: expiry, user: user, status: status },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editProductModal').hide();
                    $('#EditProductForm')[0].reset();
                    $('#updateManufacturer').removeAttr('data-id');
                    $('#updateCategory').removeAttr('data-id');
                    $('#updateSubCategory').removeAttr('data-id');
                    $('#updateUnit').removeAttr('data-id');
                    $('#search').val('');
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
                        $('#search').val('');
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


    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == '1'){
            loadProductData(`/admin/inventory/searchProduct/name`, {search:search}, '.product');
        }
        else if(searchOption == '2'){
            loadProductData(`/admin/inventory/searchProduct/category`, {search:search}, '.product')
        }
        else if(searchOption == '3'){
            loadProductData(`/admin/inventory/searchProduct/subCategory`, {search:search}, '.product')
        }
        else if(searchOption == '4'){
            loadProductData(`/admin/inventory/searchProduct/manufacturer`, {search:search}, '.product')
        }
        else if(searchOption == '5'){
            loadProductData(`/admin/inventory/searchProduct/mrp`, {search:search}, '.product')
        }
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == '1'){
            loadProductData(`/admin/inventory/product/namePagination?page=${page}`, {search:search}, '.product');
        }
        else if(searchOption == '2'){
            loadProductData(`/admin/inventory/product/categorPagination?page=${page}`, {search:search}, '.product')
        }
        else if(searchOption == '3'){
            loadProductData(`/admin/inventory/product/subCategoryPagination?page=${page}`, {search:search}, '.product')
        }
        else if(searchOption == '4'){
            loadProductData(`/admin/inventory/product/manufacturerPagination?page=${page}`, {search:search}, '.product')
        }
        else if(searchOption == '5'){
            loadProductData(`/admin/inventory/product/mrpPagination?page=${page}`, {search:search}, '.product')
        }
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



    //search category by id
    function getById(url, id,  object, property, targetElement1) {
        if(id==""){
            $(targetElement1).val('');
        }
        else{
            $.ajax({
                url: url,
                method: 'get',
                data:{ id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $(targetElement1).val(res[object][property]);
                    }
                }
            });
        }
    }

});