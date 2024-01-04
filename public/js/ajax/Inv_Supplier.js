$(document).ready(function () {

    /////////////// ------------------ Add Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addSupplier', function (e) {
        e.preventDefault();
        let supplierName = $('#supplierName').val();
        let supplierEmail = $('#supplierEmail').val();
        let supplierContact = $('#supplierContact').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertSuppliers",
            method: 'Post',
            data: { supplierName: supplierName,supplierEmail: supplierEmail,supplierContact: supplierContact,user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addSupplierModal').hide();
                    $('#AddSupplierForm')[0].reset();
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editSupplierModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editSuppliers/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_supplier.id);
                $('#updateSupplierName').val(res.inv_supplier.sup_name);
                $('#updateSupplierEmail').val(res.inv_supplier.sup_email);
                $('#updateSupplierContact').val(res.inv_supplier.sup_contact);
                $('#updateUser').empty();

                // Create options dynamically based on the user value
                $.each(res.user_info, function(key,user) {
                    $('#updateUser').append(`<option value="${user.id}" ${res.inv_supplier.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });

                // Create options dynamically based on the status value
                $('#updateStatus').append(`<option value="1" ${res.inv_supplier.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_supplier.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                
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
    $(document).on('click', '#updateSupplier', function (e) {
        e.preventDefault();
        let id = $('#id').val();;
        let supplierName = $('#updateSupplierName').val();
        let supplierEmail = $('#updateSupplierEmail').val();
        let supplierContact = $('#updateSupplierContact').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateSuppliers/${id}`,
            method: 'Put',
            data: { supplierName: supplierName, supplierEmail:supplierEmail, supplierContact: supplierContact, user:user, status: status },
            beforeSend:function name(params) {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editSupplierModal').hide();
                    $('#EditSupplierForm')[0].reset();
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Updated Successfully', 'Updated!');
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
    $(document).on('click', '.deleteSupplier', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Supplier ??')) {
            $.ajax({
                url: `/admin/inventory/deleteSuppliers/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.supplier').load(location.href + ' .supplier');
                        toastr.success('Supplier Deleted Successfully', 'Deleted!');
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
            url: `/admin/inventory/supplier/pagination?page=${page}`,
            success: function (res) {
                $('.supplier').html(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchSuppliers`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.supplier').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.supplier').html(res.data);
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
            url: `/admin/inventory/supplier/searchPagination?page=${page}`,
            data:{search:search},
            success: function (res) {
                if (res.status == "null") {
                    $('.supplier').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.supplier').html(res.data);
                }
            }
        });
    });

});