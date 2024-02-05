$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('click', '.add', function (e) {
        let tranType = $('#tranType').val();
        getTransactionId(tranType, '#tranId');
        
    });

    $(document).on('keyup', '#tranId', function (e) {
        let tranId = $('#tranId').val();
        getTransactionGrid(tranId, '.transaction_grid tbody', '#amount', '#totalDiscount', '#netAmount' );
    });


    ///////////// ----------------------------- calculation part start ------------------------- ///////////////////////

    $(document).on('keyup', '#receiveQty, #cp, #mrp, #discount', function (e) {
        let receiveQty = $('#receiveQty').val();
        let cp = $('#cp').val();
        let mrp = $('#mrp').val();
        
        let total_cp = cp * receiveQty;
        let total_mrp = mrp * receiveQty;
        $('#totCp').val(total_cp);
        $('#totMrp').val(total_mrp);
        $('#profit').val(profit);
    });


    //add list value in product input of add modal
    $(document).on('click', '#product-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        let mrp = $(this).data('mrp');
        let cp = $(this).data('cp');
        let receiveQty = $('#receiveQty').val();
        let total_cp = cp * receiveQty;
        let total_mrp = mrp * receiveQty;
        $('#totCp').val(total_cp);
        $('#totMrp').val(total_mrp);
        $('#product').val(value);
        $('#product').attr('data-id', id);
        $('#mrp').val(mrp);
        $('#cp').val(cp);
        $('#product-list ul').html('');
    });

    ///////////// ----------------------------- calculation part end ------------------------- ///////////////////////



    $(document).on('click', '#addTempReceiveTransaction', function (e) {
        e.preventDefault();
        let tranType = $('#tranType').val();
        let tranId = $('#tranId').val();
        let supplier = $('#supplier').attr('data-id');
        let store = $('#store').attr('data-id');
        let location = $('#location').attr('data-id');
        let receiveQty = $('#receiveQty').val();
        // let issueQty = $('#issueQty').val();
        // let balanceQty = $('#balanceQty').val();
        let product = $('#product').attr('data-id');;
        let mrp = $('#mrp').val();
        let cp = $('#cp').val();
        let totCp = $('#totCp').val();
        let totMrp = $('#totMrp').val();
        let discount = $('#discount').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/temp/transaction/insertReceiveDetails",
            method: 'Post',
            data: { tranType: tranType, tranId: tranId, supplier: supplier, store:store, location:location, receiveQty: receiveQty, product:product, mrp: mrp, cp:cp, totCp:totCp, totMrp:totMrp, discount:discount, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    getTransactionGrid(tranId, '.transaction_grid tbody', '#amount', '#totalDiscount', '#netAmount' );
                    $('#product').removeAttr('data-id');
                    $('#product').val('');
                    $('#cp').val('');
                    $('#mrp').val('');
                    $('#receiveQty').val('');
                    $('#totCp').val('');
                    $('#totMrp').val('');
                    $('#discount').val('0');
                    $('#profit').val('');
                    $('#search').val('');
                    $("#product").focus();
                    toastr.success('Transaction Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });


    

    $(document).on('click', '#addTempReceiveMainTransaction', function (e) {
        e.preventDefault();
        let tranType = $('#tranType').val();
        let tranId = $('#tranId').val();
        let supplier = $('#supplier').attr('data-id');
        let store = $('#store').attr('data-id');
        let locations = $('#location').attr('data-id');
        let invoice = $('#invoice').val();
        let amount = $('#amount').val();
        let netAmount = $('#netAmount').val();
        let totalDiscount = $('#totalDiscount').val();
        let profit = $('#profit').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/temp/transaction/insertReceiveMain",
            method: 'Post',
            data: { tranType: tranType, tranId: tranId, supplier: supplier, store:store, locations:locations, invoice:invoice, amount:amount, totalDiscount:totalDiscount, netAmount:netAmount, profit: profit, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    // getTransactionGrid(tranId, '.transaction_grid tbody');
                    $('#addTempReceiveTransactionModal').hide();
                    $('#AddReceiveTransactionForm')[0].reset();
                    $('#supplier').removeAttr('data-id');
                    $('#store').removeAttr('data-id');
                    $('#location').removeAttr('data-id');
                    $('#product').removeAttr('data-id');
                    $('.transaction_grid tbody').html('');
                    $('#search').val('');
                    $('.receive_transaction_temp').load(location.href + ' .receive_transaction_temp');
                    toastr.success('Receive Transaction Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    ///////////// ------------------ Edit Transaction Receive Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTempReceiveTransactionModal', function () {
        let modalId = $(this).data('modal-id');
        let transaction = $(this).data('transaction');
        let id = $(this).data('id');
        
        $.ajax({
            url: `/admin/inventory/temp/transaction/editReceiveDetails/${transaction}`,
            method: 'get',
            success: function (res) {
                getTransactionGrid(transaction, '.updateTransaction_grid tbody', '#updateAmount', '#updateTotalDiscount', '#updateNetAmount' );
                getReceiveDetails(id)
                console.log(res.inv_transaction);

                // $('#id').val(res.inv_supplier.id);
                // $('#updateSupplierName').val(res.inv_supplier.sup_name);
                // $('#updateSupplierEmail').val(res.inv_supplier.sup_email);
                // $('#updateSupplierContact').val(res.inv_supplier.sup_contact);
                // $('#updateSupplierAddress').val(res.inv_supplier.sup_address);
                

                // // Create options dynamically based on the user value
                // $('#updateUser').empty();
                // $.each(res.user_info, function(key,user) {
                //     $('#updateUser').append(`<option value="${user.id}" ${res.inv_supplier.user_id === user.id ? 'selected' : ''}>${user.name}</option>`);
                // });

                // // Create options dynamically based on the status value
                // $('#updateStatus').empty();
                // $('#updateStatus').append(`<option value="1" ${res.inv_supplier.status === 1 ? 'selected' : ''}>Active</option>
                //                          <option value="0" ${res.inv_supplier.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                
                // var modal = document.getElementById(modalId);

                // if (modal) {
                //     modal.style.display = 'block';
                // }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    



    $(document).on('click', '.deleteReceive', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let tranId = $('#tranId').val();
        if (confirm('Are You Sure to Delete This Receive details ??')) {
            $.ajax({
                url: `/admin/inventory/temp/transaction/deleteReceiveDetails/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        getTransactionGrid(tranId, '.transaction_grid tbody');
                        toastr.success('Supplier Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });

    //get last transaction id by transaction type function
    function getTransactionId(tranType, targetElement) {
        $.ajax({
            url: "/admin/inventory/getTransactionId",
            method: 'get',
            data: {tranType:tranType},
            success: function (res) {
                if(res.status === 'success'){
                    let tranId = res.inv_transaction.tran_id;

                    // Extract the numeric part
                    let numericPart = tranId.substring(1);

                    // Increment the numeric part
                    let newNumericPart = parseInt(numericPart) + 1;

                    // Format the new transaction ID
                    let newTranId = tranId[0] + newNumericPart.toString().padStart(numericPart.length, '0');
                    $(targetElement).val(newTranId);
                    getTransactionGrid(newTranId, '.transaction_grid tbody', '#amount', '#totalDiscount', '#netAmount' );
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }




    //Get Inserted Transacetion Grid By Transaction Id Function
    function getReceiveDetails(id) {
        $.ajax({
            url: "/admin/inventory/temp/transaction/getTransactionDetailsById",
            method: 'get',
            data: {id:id},
            success: function (res) {
                if(res.status === 'success'){
                    console.log(res);
                    $('#updateTranDate').val(res.transaction.tran_date);
                    $('#updateTranId').val(res.transaction.tran_id);
                    $('#updateInvoice').val(res.transaction.invoice_no);
                    $('#updateStore').val(res.transaction.store.store_name);
                    $('#updateLocation').val(res.transaction.location.division);
                    $('#updateSupplier').val(res.transaction.supplier.sup_name);
                    $('#updateStore').attr('data-id',res.transaction.store_id);
                    $('#updateLocation').attr('data-id',res.transaction.location_id);
                    $('#updateSupplier').attr('data-id',res.transaction.supplier_id);

                }
                else{
                    $(targetElement).html('');
                }
                
            }
        });
    }



    //Get Inserted Transacetion Grid By Transaction Id Function
    function getTransactionGrid(tranId, grid, amount="", discount="", total ="") {
        $.ajax({
            url: "/admin/inventory/temp/transaction/getTransactionGrid",
            method: 'get',
            data: {tranId:tranId},
            success: function (res) {
                if(res.status === 'success'){
                    $(grid).html(res.data);
                    
                    let transactions = res.current_transaction.data;
                    // Calculate total cp
                    let totalAmount = transactions.reduce((sum, transaction) => sum + transaction.tot_cp, 0);
                    $(amount).val(totalAmount);
                    // Calculate total discount
                    let totalDiscount = transactions.reduce((sum, transaction) => sum + transaction.discount, 0);
                    $(discount).val(totalDiscount);

                    let netAmount = totalAmount - totalDiscount;
                    $(total).val(netAmount);
                }
                else{
                    $(targetElement).html('');
                }
                
            }
        });
    }
});