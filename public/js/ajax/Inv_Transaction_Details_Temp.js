$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('click', '.add', function (e) {
        let tranType = $('#tranType').val();
        getTransactionId(tranType, '#tranId');
    });


    ///////////// ----------------------------- calculation part start ------------------------- ///////////////////////

    $(document).on('keyup', '#receiveQty, #cp, #mrp, #discount', function (e) {
        let receiveQty = $('#receiveQty').val();
        let cp = $('#cp').val();
        let mrp = $('#mrp').val();
        
        let total_cp = cp * receiveQty;
        let total_mrp = mrp * receiveQty;
        let discount = parseFloat($('#discount').val());
        let netCp = total_cp - discount;
        let profit = total_mrp - netCp;
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
        let discount = parseFloat($('#discount').val());
        let netCp = total_cp - discount;
        let profit = total_mrp - netCp;
        $('#totCp').val(total_cp);
        $('#totMrp').val(total_mrp);
        $('#profit').val(profit);
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
        let receiveQty = $('#receiveQty').val();
        // let issueQty = $('#issueQty').val();
        // let balanceQty = $('#balanceQty').val();
        let product = $('#product').attr('data-id');;
        let mrp = $('#mrp').val();
        let cp = $('#cp').val();
        let totCp = $('#totCp').val();
        let totMrp = $('#totMrp').val();
        let discount = $('#discount').val();
        let profit = $('#profit').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/temp/transaction/insertReceiveDetails",
            method: 'Post',
            data: { tranType: tranType, tranId: tranId, supplier: supplier, receiveQty: receiveQty, product:product, mrp: mrp, cp:cp, totCp:totCp, totMrp:totMrp, discount:discount, profit: profit, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    console.log(tranId);
                    getTransactionGrid(tranId, '.transaction_grid tbody');
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
                console.log(err)
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
        let invoice = $('#invoice').val();
        let amount = $('#amount').val();
        let netAmount = $('#netAmount').val();
        let totalDiscount = $('#totalDiscount').val();
        let profit = $('#profit').val();
        let user = $('#user').val();
        $.ajax({
            url: "/admin/inventory/temp/transaction/insertReceiveMain",
            method: 'Post',
            data: { tranType: tranType, tranId: tranId, supplier: supplier, invoice:invoice, amount:amount, totalDiscount:totalDiscount, netAmount:netAmount, profit: profit, user: user },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    console.log(res)
                    // getTransactionGrid(tranId, '.transaction_grid tbody');
                    $('#addTempReceiveTransactionModal').hide();
                    $('#AddReceiveTransactionForm')[0].reset();
                    $('#supplier').removeAttr('data-id');
                    $('#product').removeAttr('data-id');
                    $('.transaction_grid tbody').html('');
                    $('#search').val('');
                    $('.receive_transaction_temp').load(location.href + ' .receive_transaction_temp');
                    toastr.success('Receive Transaction Added Successfully', 'Added!');
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
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }




    //Get Inserted Transacetion Grid By Transaction Id Function
    function getTransactionGrid(tranId, targetElement) {
        $.ajax({
            url: "/admin/inventory/temp/transaction/getTransactionGrid",
            method: 'get',
            data: {tranId:tranId},
            success: function (res) {
                if(res.status === 'success'){
                    $(targetElement).html(res.data);
                    
                    let transactions = res.current_transaction.data;
                    // Calculate total cp
                    let totalAmount = transactions.reduce((sum, transaction) => sum + transaction.tot_cp, 0);
                    $('#amount').val(totalAmount);
                    // Calculate total discount
                    let totalDiscount = transactions.reduce((sum, transaction) => sum + transaction.discount, 0);
                    $('#totalDiscount').val(totalDiscount);

                    let netAmount = totalAmount - totalDiscount;
                    $('#netAmount').val(netAmount);
                }
                else{
                    $(targetElement).html('');
                }
                
            }
        });
    }
});