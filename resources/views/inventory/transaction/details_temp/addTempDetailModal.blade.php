@section('style')
    <style>
        .modal-subject {
            width: 90%;
        }
    </style>
@endsection

<div id="addTempTransactionModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Temp Transactions</h3>
            <span class="close-modal" data-modal-id="addTempTransactionModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Temp Transactions</h3>
                    </div>
                </div>

                <form id="AddTempTransactionForm" method="post">
                    @csrf 
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tranDate">Date</label>
                                        <input type="text" name="tranDate" class="input-small"  id="tranDate" value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="tranDate_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tranType">Transaction Type</label>
                                        <select name="tranType" class="select" id="tranType">
                                            <option value="">Transaction Status</option>
                                            <option value="R">Receive</option>
                                            <option value="I">Issue</option>
                                            <option value="E">Return</option>
                                            <option value="N">Negative</option>
                                            <option value="P">Positive</option>
                                        </select>
                                        <span class="text-danger error" id="tranType_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tranId">Transaction Id</label>
                                        <input type="text" name="tranId" class="input-small"  id="tranId" disabled>
                                        <span class="text-danger error" id="tranId_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sl">Serial</label>
                                        <input type="text" name="sl" class="input-small"  id="sl">
                                        <span class="text-danger error" id="sl_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" name="supplier" class="input-small"  id="supplier">
                                        <span class="text-danger error" id="supplier_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="client">Client</label>
                                        <input type="text" name="client" class="input-small"  id="client">
                                        <span class="text-danger error" id="client_error"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="receiveQty">Receive Qty</label>
                                        <input type="text" name="receiveQty" class="input-small"  id="receiveQty">
                                        <span class="text-danger error" id="receiveQty_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="issueQty">Issue Qty</label>
                                        <input type="text" name="issueQty" class="input-small"  id="issueQty">
                                        <span class="text-danger error" id="issueQty_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="balanceQty">Balance Qty</label>
                                        <input type="text" name="balanceQty" class="input-small"  id="balanceQty">
                                        <span class="text-danger error" id="balanceQty_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product">Product</label>
                                        <input type="text" name="product" class="input-small"  id="product">
                                        <span class="text-danger error" id="product_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cp">Cp</label>
                                        <input type="text" name="cp" class="input-small"  id="cp">
                                        <span class="text-danger error" id="cp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mrp">Mrp</label>
                                        <input type="text" name="mrp" class="input-small"  id="mrp">
                                        <span class="text-danger error" id="mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totCp">Total Cp</label>
                                        <input type="text" name="totCp" class="input-small"  id="totCp" disabled>
                                        <span class="text-danger error" id="totCp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totMrp">Total Mrp</label>
                                        <input type="text" name="totMrp" class="input-small"  id="totMrp" disabled>
                                        <span class="text-danger error" id="totMrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" name="discount" class="input-small"  id="discount">
                                        <span class="text-danger error" id="discount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="profit">Profit</label>
                                        <input type="text" name="profit" class="input-small"  id="profit" disabled>
                                        <span class="text-danger error" id="profit_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="receive">Receive Id</label>
                                        <input type="text" name="receive" class="input-small"  id="receive">
                                        <span class="text-danger error" id="receive_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">User id:</label>
                                        <select name="user" class="select" id="user">
                                            <option value="">User id</option>
                                            @foreach($user_info as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="select" id="status">
                                            <option value="">Status</option>
                                            <option value="R">Receive</option>
                                            <option value="I">Issue</option>
                                            <option value="E">Return</option>
                                            <option value="N">Negative</option>
                                            <option value="P">Positive</option>
                                        </select>
                                        <span class="text-danger error" id="status_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="addTempTransaction" class="btn btn-primary">Submit</button>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="invoice">Invoice No</label>
                                        <input type="text" name="invoice" class="form-control"  id="invoice">
                                        <span class="text-danger error" id="invoice_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount">Invoice Amount</label>
                                        <input type="text" name="amount" class="form-control"  id="amount">
                                        <span class="text-danger error" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" name="discount" class="form-control"  id="discount">
                                        <span class="text-danger error" id="discount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="netAmount">Net Amount</label>
                                        <input type="text" name="netAmount" class="form-control"  id="netAmount">
                                        <span class="text-danger error" id="netAmount_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


