$(document).ready(function () {

    /////////////// ------------------ Add Store ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addStore', function (e) {
        e.preventDefault();
        let storeName = $('#storeName').val();
        let locations = $('#location').val();
        $.ajax({
            url: "/admin/inventory/insertStores",
            method: 'Post',
            data: { storeName:storeName, locations:locations },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addStoreModal').hide();
                    $('#AddStoreForm')[0].reset();
                    $('.store').load(location.href + ' .store');
                    toastr.success('Store Added Successfully', 'Added!');
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



    // ///////////// ------------------ Edit Product Category ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '.editManufacturerModal', function () {
    //     let modalId = $(this).data('modal-id');
    //     let id = $(this).data('id');
    //     $.ajax({
    //         url: `/admin/inventory/editManufacturers/${id}`,
    //         method: 'get',
    //         success: function (res) {
    //             $('#id').val(res.inv_manufacturer.id);
    //             $('#updateManufacturerName').val(res.inv_manufacturer.manufacturer_name);
    //             $('#updateManufacturerEmail').val(res.inv_manufacturer.manufacturer_email);
    //             $('#updateManufacturerContact').val(res.inv_manufacturer.manufacturer_contact);
    //             $('#updateUser').empty();

    //             // Create options dynamically based on the user value
    //             $.each(res.user_info, function(key,user) {
    //                 $('#updateUser').append(`<option value="${user.id}" ${res.inv_manufacturer.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
    //             });

    //             // Create options dynamically based on the status value
    //             $('#updateStatus').append(`<option value="1" ${res.inv_manufacturer.status === 1 ? 'selected' : ''}>Active</option>
    //                                      <option value="0" ${res.inv_manufacturer.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                
    //             var modal = document.getElementById(modalId);

    //             if (modal) {
    //                 modal.style.display = 'block';
    //             }
    //         },
    //         error: function (err) {
    //             console.log(err);
    //         }
    //     });
    // });



    // /////////////// ------------------ Update Product Category ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '#updateManufacturer', function (e) {
    //     e.preventDefault();
    //     let id = $('#id').val();;
    //     let manufacturerName = $('#updateManufacturerName').val();
    //     let manufacturerEmail = $('#updateManufacturerEmail').val();
    //     let manufacturerContact = $('#updateManufacturerContact').val();
    //     let user = $('#updateUser').val();
    //     let status = $('#updateStatus').val();
    //     $.ajax({
    //         url: `/admin/inventory/updateManufacturers/${id}`,
    //         method: 'Put',
    //         data: { manufacturerName: manufacturerName, manufacturerEmail:manufacturerEmail, manufacturerContact: manufacturerContact, user:user, status: status },
    //         beforeSend:function name(params) {
    //             $(document).find('span.error').text('');  
    //         },
    //         success: function (res) {
    //             if (res.status == "success") {
    //                 $('#editManufacturerModal').hide();
    //                 $('#EditManufacturerForm')[0].reset();
    //                 $('.manufacturer').load(location.href + ' .manufacturer');
    //                 toastr.success('Manufacturer Updated Successfully', 'Updated!');
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (key, value) {
    //                 $('#update_' + key + "_error").text(value);
    //             })
    //         }
    //     });
    // });



    /////////////// ------------------ Delete Store ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteStore', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Store ??')) {
            $.ajax({
                url: `/admin/inventory/deleteStores/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.store').load(location.href + ' .store');
                        toastr.success('Store Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/store/pagination?page=${page}`,
            success: function (res) {
                $('.store').html(res);
            },
            error:function(res) {
                console.log(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchStores`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.store').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.store').html(res.data);
                    $('.paginate').html(res.pagination);
                }
            }
        });
    });

});