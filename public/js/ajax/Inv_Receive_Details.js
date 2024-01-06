$(document).ready(function () {

    /////////////// ------------------ Add Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addReceiveDetail', function (e) {
        e.preventDefault();
        let supplier = $('#supplier').val();
        let invoice = $('#invoice').val();
        let product = $('#product').val();
        let batch = $('#batch').val();
        let cp = $('#cp').val();
        let discount = $('#discount').val();
        let expiry = $('#expiry').val();
        let quantity = $('#quantity').val();
        let mrp = $('#mrp').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/insertReceiveDetails",
            method: 'Post',
            data: { supplier: supplier, invoice:invoice, product:product, batch:batch, cp:cp, discount:discount, expiry:expiry, mrp:mrp, quantity:quantity, user:user },
            beforeSend:function() {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addReceiveDetailModal').hide();
                    $('#AddReceiveDetailForm')[0].reset();
                    $('.receive-detail').load(location.href + ' .receive-detail');
                    toastr.success('Receive Details Added Successfully', 'Added!');
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



    /////////////// ------------------ Edit Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editReceiveDetailModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editReceiveDetails/${id}`,
            method: 'get',
            success: function (res) {
                //taking only the date part from timstamp value
                let timestamp = res.inv_receive_details.receive_date;
                var datePart = timestamp.substring(0, 10);

                $('#id').val(res.inv_receive_details.id);
                $('#updateReceive').val(datePart);

                $.each(res.inv_supplier, function(key,supplier) {
                    $('#updateSupplier').append(`<option value="${supplier.id}" ${res.inv_receive_details.supplier_id === supplier.id ? 'selected' : ''}>${supplier.sup_name}</option>`);
                });

                $('#updateInvoice').val(res.inv_receive_details.invoice_no);

                $('#updateProduct').val();
                $.each(res.inv_product, function(key,product) {
                    $('#updateProduct').append(`<option value="${product.id}" ${res.inv_receive_details.product_id === product.id ? 'selected' : ''}>${product.product_name}</option>`);
                });

                $('#updateBatch').val(res.inv_receive_details.batch_no);

                $('#updateCp').val(res.inv_receive_details.cp);
                $('#updateDiscount').val(res.inv_receive_details.discount);
                $('#updateExpiry').val(res.inv_receive_details.expiry_date);
                $('#updateQuantity').val(res.inv_receive_details.quantity);
                $('#updateMrp').val(res.inv_receive_details.mrp);
                

                $.each(res.user_info, function(key,user) {
                    $('#updateUser').append(`<option value="${user.id}" ${res.inv_receive_details.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });
                
                // Create options dynamically based on the status value
                $('#updateStatus').html(`<option value="1" ${res.inv_receive_details.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_receive_details.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                

                let total = res.inv_receive_details.cp * res.inv_receive_details.quantity;
                $('.total').text(total)


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



    /////////////// ------------------ Update Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateReceiveDetail', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let supplier = $('#updateSupplier').val();
        let invoice = $('#updateInvoice').val();
        let product = $('#updateProduct').val();
        let batch = $('#updateBatch').val();
        let cp = $('#updateCp').val();
        let discount = $('#updateDiscount').val();
        let expiry = $('#updateExpiry').val();
        let quantity = $('#updateQuantity').val();
        let mrp = $('#updateMrp').val();
        let user = $('#updateUser').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateReceiveDetails/${id}`,
            method: 'Put',
            data: { supplier: supplier, invoice:invoice, product:product, batch:batch, cp:cp, discount:discount, expiry:expiry, mrp:mrp, quantity:quantity, user:user, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editReceiveDetailModal').hide();
                    $('#EditReceiveDetailForm')[0].reset();
                    $('.receive-detail').load(location.href + ' .receive-detail');
                    toastr.success('Receive Details Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteReceiveDetail', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Receive Details??')) {
            $.ajax({
                url: `/admin/inventory/deleteReceiveDetails/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.receive-detail').load(location.href + ' .receive-detail');
                        toastr.success('Receive Details Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadReceiveDetailsData(`/admin/inventory/receiveDetail/pagination?page=${page}`, {}, '.receive-detail');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadReceiveDetailsData(`/admin/inventory/searchReceiveDetails`, {search:search}, '.receive-detail');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadReceiveDetailsData(`/admin/inventory/receiveDetail/searchPagination?page=${page}`, {search:search}, '.receive-detail');
    });


    //product pagination data load function
    function loadReceiveDetailsData(url, data, targetElement) {
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