$(document).ready(function () {

    /////////////// ------------------ Add Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addClient', function (e) {
        e.preventDefault();
        let clientName = $('#clientName').val();
        let contact = $('#contact').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertClients",
            method: 'Post',
            data: { clientName: clientName,contact: contact,user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addClientModal').hide();
                    $('#AddClientForm')[0].reset();
                    $('.client').load(location.href + ' .client');
                    toastr.success('Client Added Successfully', 'Added!');
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
    // $(document).on('click', '.editClientModal', function () {
    //     let modalId = $(this).data('modal-id');
    //     let id = $(this).data('id');
    //     $.ajax({
    //         url: `/admin/inventory/editclients/${id}`,
    //         method: 'get',
    //         success: function (res) {
    //             $('#id').val(res.inv_client.id);
    //             $('#updateClientName').val(res.inv_client.client_name);
    //             $('#updateContact').val(res.inv_client.client_contact);
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



    /////////////// ------------------ Delete Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteClient', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Client ??')) {
            $.ajax({
                url: `/admin/inventory/deleteClients/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.client').load(location.href + ' .client');
                        toastr.success('Client Deleted Successfully', 'Deleted!');
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
            url: `/admin/inventory/client/pagination?page=${page}`,
            success: function (res) {
                $('.client').html(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchClients`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.client').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.client').html(res.data);
                    $('.paginate').html(res.pagination);
                }
            }
        });
    });

});