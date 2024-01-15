$(document).ready(function () {
    
    /////////////// ------------------ Add Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addReceiveDetail', function (e) {
        e.preventDefault();
        let supplier = $('#supplier').attr('data-id');
        let invoice = $('#invoice').val();
        let product = $('#product').attr('data-id');
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
            data: { supplier: supplier, invoice: invoice, product: product, batch: batch, cp: cp, discount: discount, expiry: expiry, mrp: mrp, quantity: quantity, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addReceiveDetailModal').hide();
                    $('#AddReceiveDetailForm')[0].reset();
                    $('#product').removeAttr('data-id');
                    $('#search').val('');
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
                

                $('#updateSupplier').val(res.inv_receive_details.supplier_name.sup_name);
                $('#updateSupplier').attr('data-id',res.inv_receive_details.supplier_id);

                $('#updateBatch').val(res.inv_receive_details.batch_no);
                $('#updateInvoice').val(res.inv_receive_details.invoice_no);
                $('#updateExpiry').val(res.inv_receive_details.expiry_date);
                
                $('#updateProduct').val('data-id', res.inv_receive_details.product_name.product_name);
                $('#updateProduct').attr('data-id', res.inv_receive_details.product_id);
                $('#updateMrp').val(res.inv_receive_details.mrp);

                

                $('#updateCp').val(res.inv_receive_details.cp);
                $('#updateDiscount').val(res.inv_receive_details.discount);
                $('#updateQuantity').val(res.inv_receive_details.quantity);

                $('#updateUser').html('')
                $('#updateUser').append('<option>User</option>')
                $.each(res.user_info, function (key, user) {
                    $('#updateUser').append(`<option value="${user.id}" ${res.inv_receive_details.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                });

                // Create options dynamically based on the status value
                $('#updateStatus').html(`<option value="1" ${res.inv_receive_details.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_receive_details.status === 0 ? 'selected' : ''}>Inactive</option>`);


                let total = res.inv_receive_details.cp * res.inv_receive_details.quantity;
                let netTotal = total - total*(res.inv_receive_details.discount/100); 
                $('#updateTotal').val(total);
                $('#updateTotalDiscount').val(res.inv_receive_details.discount);
                $('#updateNetTotal').val(netTotal);
                $('#updateBalance').val(netTotal);

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
        let supplier = $('#updateSupplier').attr('data-id');
        let invoice = $('#updateInvoice').val();
        let product = $('#updateProduct').attr('data-id');
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
            data: { supplier: supplier, invoice: invoice, product: product, batch: batch, cp: cp, discount: discount, expiry: expiry, mrp: mrp, quantity: quantity, user: user, status: status },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editReceiveDetailModal').hide();
                    $('#EditReceiveDetailForm')[0].reset();
                    $('#updateProduct').removeAttr('data-id');
                    $('#search').val('');
                    $('.receive-detail').load(location.href + ' .receive-detail');
                    toastr.success('Receive Details Updated Successfully', 'Updated!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#update_' + key + "_error").text(value);
                })
                toastr.error('error.errors', 'Error!');
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
                        $('#search').val('');
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
        let searchOption = $("#searchOption").val();
        if(searchOption == '1'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/supplier`, {search:search}, '.receive-detail');
        }
        else if(searchOption == '2'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/product`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '3'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/invoice`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '4'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/batch`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '5'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/cp`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '6'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/discount`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '7'){
            loadReceiveDetailsData(`/admin/inventory/searchReceiveDetail/expiry`, {search:search}, '.receive-detail')
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
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/supplierPagination?page=${page}`, {search:search}, '.receive-detail');
        }
        else if(searchOption == '2'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/productPagination?page=${page}`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '3'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/invoicePagination?page=${page}`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '4'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/batchPagination?page=${page}`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '5'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/cpPagination?page=${page}`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '6'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/discountPagination?page=${page}`, {search:search}, '.receive-detail')
        }
        else if(searchOption == '7'){
            loadReceiveDetailsData(`/admin/inventory/receiveDetail/expiryPagination?page=${page}`, {search:search}, '.receive-detail')
        }
        
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
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

    /////////////// ------------------ Calculation ajax part start ---------------- /////////////////////////////

    $('#cp, #discount, #quantity, #paid').on('input', function () {
        let cp = parseFloat($('#cp').val())||"";
        let discount = parseFloat($('#discount').val()) || "";
        let quantity = parseFloat($('#quantity').val()) || "";
        let paid = parseFloat($('#paid').val()) || "";
        let total = cp * quantity;
        let netTotal = total - total*(discount/100);
        let due = netTotal - paid;
        
        $('#total').val(total)
        $('#totalDiscount').val(discount)
        $('#netTotal').val(netTotal)
        $('#balance').val(due)
    });



    $('#updateCp, #updateDiscount, #updateQuantity, #updatePaid').on('input', function () {
        let cp = parseFloat($('#updateCp').val())||"";
        let discount = parseFloat($('#updateDiscount').val()) || "";
        let quantity = parseFloat($('#updateQuantity').val()) || "";
        let paid = parseFloat($('#updatePaid').val()) || "";
        let total = cp * quantity;
        let netTotal = total - total*(discount/100);
        let due = netTotal - paid;
        
        $('#updateTotal').val(total)
        $('#updateTotalDiscount').val(discount)
        $('#updateNetTotal').val(netTotal)
        $('#updateBalance').val(due)
    });

    /////////////// ------------------ Calculation ajax part end ---------------- /////////////////////////////

});