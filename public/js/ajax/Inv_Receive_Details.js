$(document).ready(function () {
    /////////////// ------------------ Search product by name and add value to input ajax part start ---------------- /////////////////////////////
    //search product on add modal
    $(document).on('keyup', '#product', function () {
        let name = $(this).val();
        $('#product').removeAttr('data-id');
        $('#mrp').val('');
        getProductByName(name, '#product-list ul');
    });

    //add list value in product input of add modal
    $(document).on('click', '#product-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#product').val(value);
        $('#product').attr('data-id', id);
        $('#product-list ul').html('');
        getProductById(id, '#mrp');
    });

    //search product on edit modal
    $(document).on('keyup', '#updateProduct', function () {
        let name = $(this).val();
        $('#updateMrp').empty();
        $('#updateProduct').removeAttr('data-id');
        getProductByName(name, '#update-product ul');
    });


    //add list value in product input of add modal
    $(document).on('click', '#update-product li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateProduct').val(value);
        $('#updateProduct').attr('data-id', id);
        $('#update-product ul').html('');
        getProductById(id, '#updateMrp');
    });


    //search product by id
    function getProductById(id, targetElement1, targetElement2="") {
        if(id==""){
            $(targetElement1).val('');
            $(targetElement2).val('');
        }
        else{
            $.ajax({
                url: `/admin/inventory/getProductById/${id}`,
                method: 'get',
                success: function (res) {
                    if (res.status == "success") {
                        $(targetElement1).val(res.inv_product.mrp);
                        $(targetElement2).val(res.inv_product.product_name);
                    }
                }
            });
        }
    }

    //search product by name
    function getProductByName(name, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getProductByName",
            method: 'get',
            data: {name:name},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }


    /////////////// ------------------ Search product by name and add value to input ajax part end ---------------- /////////////////////////////

    


    /////////////// ------------------ Add Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addReceiveDetail', function (e) {
        e.preventDefault();
        let supplier = $('#supplier').val();
        let invoice = $('#invoice').val();
        let product = $('#product').attr('data-id');
        // let product = $('#product').val();
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
                
                $('#updateSupplier').html('')
                $('#updateSupplier').append('<option>Supplier</option>')
                $.each(res.inv_supplier, function (key, supplier) {
                    $('#updateSupplier').append(`<option value="${supplier.id}" ${res.inv_receive_details.supplier_id === supplier.id ? 'selected' : ''}>${supplier.sup_name}</option>`);
                });
                $('#updateBatch').val(res.inv_receive_details.batch_no);
                $('#updateInvoice').val(res.inv_receive_details.invoice_no);
                $('#updateExpiry').val(res.inv_receive_details.expiry_date);
                
                
                getProductById(res.inv_receive_details.product_id, "#updateMrp","#updateProduct")
                $('#updateProduct').attr('data-id', res.inv_receive_details.product_id);

                

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
        let supplier = $('#updateSupplier').val();
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
        loadReceiveDetailsData(`/admin/inventory/searchReceiveDetails`, { search: search }, '.receive-detail');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadReceiveDetailsData(`/admin/inventory/receiveDetail/searchPagination?page=${page}`, { search: search }, '.receive-detail');
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