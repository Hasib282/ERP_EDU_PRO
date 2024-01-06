$(document).ready(function () {

    /////////////// ------------------ Add Product Category ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addManufacturer', function (e) {
        e.preventDefault();
        let manufacturerName = $('#manufacturerName').val();
        let manufacturerEmail = $('#manufacturerEmail').val();
        let manufacturerContact = $('#manufacturerContact').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertManufacturers",
            method: 'Post',
            data: { manufacturerName: manufacturerName,manufacturerEmail: manufacturerEmail,manufacturerContact: manufacturerContact,user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addManufacturerModal').hide();
                    $('#AddManufacturerForm')[0].reset();
                    $('.manufacturer').load(location.href + ' .manufacturer');
                    toastr.success('Manufacturer Added Successfully', 'Added!');
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
    $(document).on('click', '.editManufacturerModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editManufacturers/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_manufacturer.id);
                $('#updateManufacturerName').val(res.inv_manufacturer.manufacturer_name);
                $('#updateManufacturerEmail').val(res.inv_manufacturer.manufacturer_email);
                $('#updateManufacturerContact').val(res.inv_manufacturer.manufacturer_contact);
                $('#updateUser').empty();

                // Create options dynamically based on the user value
                $.each(res.user_info, function(key,user) {
                    $('#updateUser').append(`<option value="${user.id}" ${res.inv_manufacturer.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });

                // Create options dynamically based on the status value
                $('#updateStatus').append(`<option value="1" ${res.inv_manufacturer.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_manufacturer.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                
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
    $(document).on('click', '#updateManufacturer', function (e) {
        e.preventDefault();
        let id = $('#id').val();;
        let manufacturerName = $('#updateManufacturerName').val();
        let manufacturerEmail = $('#updateManufacturerEmail').val();
        let manufacturerContact = $('#updateManufacturerContact').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateManufacturers/${id}`,
            method: 'Put',
            data: { manufacturerName: manufacturerName, manufacturerEmail:manufacturerEmail, manufacturerContact: manufacturerContact, user:user, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editManufacturerModal').hide();
                    $('#EditManufacturerForm')[0].reset();
                    $('.manufacturer').load(location.href + ' .manufacturer');
                    toastr.success('Manufacturer Updated Successfully', 'Updated!');
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
    $(document).on('click', '.deleteManufacturer', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Manufacturer ??')) {
            $.ajax({
                url: `/admin/inventory/deleteManufacturers/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.manufacturer').load(location.href + ' .manufacturer');
                        toastr.success('Manufacturer Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadManufacturerData(`/admin/inventory/manufacturer/pagination?page=${page}`, {}, '.manufacturer');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadManufacturerData(`/admin/inventory/searchManufacturers`, {search:search}, '.manufacturer');
    });


    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadManufacturerData(`/admin/inventory/manufacturer/searchPagination?page=${page}`, {search:search}, '.manufacturer');
    });


    //product Manufacturer data load function
    function loadManufacturerData(url, data, targetElement) {
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