$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('change', '#tranType', function (e) {
        let tranType = $('#tranType').val();
        getTransactionId(tranType, '#tranId');
    });


    ///////////// ----------------------------- calculation part start ------------------------- ///////////////////////

    $(document).on('keyup', '#balanceQty, #cp, #mrp, #discount', function (e) {
        let balanceQty = $('#balanceQty').val();
        let cp = $('#cp').val();
        let mrp = $('#mrp').val();
        
        let total_cp = cp * balanceQty;
        let total_mrp = mrp * balanceQty;
        let discount = parseFloat($('#discount').val());
        let profit = total_mrp - total_cp;
        let netProfit = profit + discount;
        console.log(balanceQty);
        $('#totCp').val(total_cp);
        $('#totMrp').val(total_mrp);
        $('#profit').val(netProfit);
    });


    //add list value in product input of add modal
    $(document).on('click', '#product-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        let mrp = $(this).data('mrp');
        let cp = $(this).data('cp');
        let balanceQty = $('#balanceQty').val();
        let total_cp = cp * balanceQty;
        let total_mrp = mrp * balanceQty;
        let discount = parseFloat($('#discount').val());
        console.log('Type of discount:', typeof discount);
        let profit = total_mrp - total_cp;
        let netProfit = profit + discount;
        $('#totCp').val(total_cp);
        $('#totMrp').val(total_mrp);
        $('#profit').val(netProfit);
        $('#product').val(value);
        $('#product').attr('data-id', id);
        $('#mrp').val(mrp);
        $('#cp').val(cp);
        $('#product-list ul').html('');
    });

    ///////////// ----------------------------- calculation part end ------------------------- ///////////////////////

    $(document).on('click', '#addTempTransaction', function (e) {
        e.preventDefault();
        let tranType = $('#tranType').val();
        let tranId = $('#tranId').val();
        let sl = $('#sl').val();
        let supplier = $('#supplier').attr('data-id');
        let client = $('#client').attr('data-id');
        let receiveQty = $('#receiveQty').val();
        let issueQty = $('#issueQty').val();
        let balanceQty = $('#balanceQty').val();
        let product = $('#product').attr('data-id');;
        let mrp = $('#mrp').val();
        let cp = $('#cp').val();
        let totCp = $('#totCp').val();
        let totMrp = $('#totMrp').val();
        let discount = $('#discount').val();
        let profit = $('#profit').val();
        let receive = $('#receive').val();
        let user = $('#user').val();
        let status = $('#status').val();
        $.ajax({
            url: "/admin/inventory/insertTransactionDetailTemp",
            method: 'Post',
            data: { tranType: tranType, tranId: tranId, sl: sl, supplier: supplier, client: client, receiveQty: receiveQty, issueQty:issueQty, balanceQty:balanceQty, product:product, mrp: mrp, cp:cp, totCp:totCp, totMrp:totMrp, discount:discount, profit: profit, receive:receive, user: user, status:status },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    console.log(tranId);
                    getTransactionGrid(tranId, '.transaction_grid')
                    // $('#addProductModal').hide();
                    // $('#AddProductForm')[0].reset();
                    // $('#manufacturer').removeAttr('data-id');
                    // $('#category').removeAttr('data-id');
                    // $('#subCategory').removeAttr('data-id');
                    // $('#unit').removeAttr('data-id');
                    // $('#search').val('');
                    // $('.product').load(location.href + ' .product');
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
            url: "/admin/inventory/getTransactionGrid",
            method: 'get',
            data: {tranId:tranId},
            success: function (res) {
                if(res.status === 'success'){
                    console.log(res);
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