$(document).ready(function () {
    /////////////// ------------------ Add Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addClient', function (e) {
        e.preventDefault();
        let clientName = $('#clientName').val();
        let contact = $('#contact').val();
        let email = $('#email').val();
        let address = $('#address').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertClients",
            method: 'Post',
            data: { clientName: clientName,contact: contact, email:email, address:address, user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addClientModal').hide();
                    $('#AddClientForm')[0].reset();
                    $('.client').load(location.href + ' .client');
                    $('#search').val('');
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



    ///////////// ------------------ Edit Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editClientModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editClients/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_client.id);
                $('#updateClientName').val(res.inv_client.client_name);
                $('#updateContact').val(res.inv_client.client_contact);
                $('#updateEmail').val(res.inv_client.client_email);
                $('#updateAddress').val(res.inv_client.client_contact);
                

                // Create options dynamically based on the user value
                $('#updateUser').empty();
                $.each(res.user_info, function(key,user) {
                    $('#updateUser').html(`<option value="${user.id}" ${res.inv_client.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });

                // Create options dynamically based on the status value
                $('#updateStatus').empty();
                $('#updateStatus').html(`<option value="1" ${res.inv_client.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_client.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
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



    /////////////// ------------------ Update Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateClient', function (e) {
        e.preventDefault();
        let id = $('#id').val();;
        let clientName = $('#updateClientName').val();
        let contact = $('#updateContact').val();
        let email = $('#updateEmail').val();
        let address = $('#updateAddress').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateClients/${id}`,
            method: 'Put',
            data: { clientName: clientName, contact:contact, email:email, address:address, user:user, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editClientModal').hide();
                    $('#EditClientForm')[0].reset();
                    $('#search').val('');
                    $('.client').load(location.href + ' .client');
                    toastr.success('Client Updated Successfully', 'Updated!');
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
                        $('#search').val('');
                        toastr.success('Client Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadClientData( `/admin/inventory/client/pagination?page=${page}`, {}, '.client');
    });


    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadClientData(`/admin/inventory/searchClients`, {search:search}, '.client');
    });




    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadClientData(`/admin/inventory/client/searchPagination?page=${page}`, {search:search}, '.client');
    });



    //Client data load function
    function loadClientData(url, data, targetElement) {
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