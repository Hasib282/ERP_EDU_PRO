@section('style')
    <style>
        .modal-subject {
            width: 90%;
        }
    </style>
@endsection

<div id="addTempReceiveTransactionModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Temp Transactions</h3>
            <span class="close-modal" data-modal-id="addTempReceiveTransactionModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <form id="AddReceiveTransactionForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="tranDate">Date</label>
                                    <input type="text" name="tranDate" class="input-small" id="tranDate"
                                        value="{{ date('Y-m-d') }}" disabled>
                                    <span class="text-danger error" id="tranDate_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="tranType">Transaction Type</label>
                                    <select name="tranType" class="select-small" id="tranType" disabled>
                                        <option value="">Transaction Status</option>
                                        <option value="R" selected>Receive</option>
                                        <option value="I">Issue</option>
                                        <option value="E">Return</option>
                                        <option value="N">Negative</option>
                                        <option value="P">Positive</option>
                                    </select>
                                    <span class="text-danger error" id="tranType_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="tranId">Transaction Id</label>
                                    <input type="text" name="tranId" class="input-small" id="tranId" disabled>
                                    <span class="text-danger error" id="tranId_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="invoice">Invoice No</label>
                                    <input type="text" name="invoice" class="input-small" id="invoice">
                                    <span class="text-danger error" id="invoice_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="supplier">Supplier</label>
                                    <input type="text" name="supplier" class="input-small" id="supplier" autocomplete="off">
                                    <div id="supplier-list">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="supplier_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="product">Product</label>
                                    <input type="text" name="product" class="input-small" id="product" autocomplete="off">
                                    <div id="product-list">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="product_error"></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="cp">Cp</label>
                                    <input type="text" name="cp" class="input-small" id="cp">
                                    <span class="text-danger error" id="cp_error"></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="mrp">Mrp</label>
                                    <input type="text" name="mrp" class="input-small" id="mrp">
                                    <span class="text-danger error" id="mrp_error"></span>
                                </div>

                                <div class="col-md-4">
                                    <label for="receiveQty">Receive Qty</label>
                                    <input type="text" name="receiveQty" class="input-small" id="receiveQty">
                                    <span class="text-danger error" id="receiveQty_error"></span>
                                </div>
                                {{-- <div class="col-md-2">
                                    <label for="issueQty">Issue Qty</label>
                                    <input type="text" name="issueQty" class="input-small" id="issueQty">
                                    <span class="text-danger error" id="issueQty_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="balanceQty">Balance Qty</label>
                                    <input type="text" name="balanceQty" class="input-small" id="balanceQty">
                                    <span class="text-danger error" id="balanceQty_error"></span>
                                </div> --}}
                                
                                <div class="col-md-4">
                                    <label for="totCp">Total Cp</label>
                                    <input type="text" name="totCp" class="input-small" id="totCp"
                                        disabled>
                                    <span class="text-danger error" id="totCp_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="totMrp">Total Mrp</label>
                                    <input type="text" name="totMrp" class="input-small" id="totMrp"
                                        disabled>
                                    <span class="text-danger error" id="totMrp_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="discount">Discount</label>
                                    <input type="text" name="discount" class="input-small" id="discount" value="0">
                                    <span class="text-danger error" id="discount_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="profit">Profit</label>
                                    <input type="text" name="profit" class="input-small" id="profit"
                                        disabled>
                                    <span class="text-danger error" id="profit_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="user">User id:</label>
                                    <select name="user" class="select-small" id="user">
                                        <option value="">User id</option>
                                        @foreach ($user_info as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="user_error"></span>
                                </div>
                                <div class="center">
                                    <button type="submit" id="addTempReceiveTransaction"
                                        class="btn btn-success addButton">Add + </button>
                                </div>
                            </div>


                            <div class="row grid">
                                <div class="col-md-8">
                                    <div class="transaction_grid">
                                        <table class="show-table">
                                            <thead>
                                                <tr>
                                                    <th>SL:</th>
                                                    <th>Supplier</th>
                                                    <th>Product</th>
                                                    <th>Receive Qty</th>
                                                    <th>Cp</th>
                                                    <th>Total Cp</th>
                                                    <th>Discount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <table style="width: 100%">
                                        <tr>
                                            <td><label for="amount">Invoice Amount</label></td>
                                            <td><input type="text" name="amount" class="input-small" id="amount"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="totalDiscount">Discount</label></td>
                                            <td><input type="text" name="totalDiscount" class="input-small" id="totalDiscount"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="netAmount">Net Amount</label>
                                            <td><input type="text" name="netAmount" class="input-small" id="netAmount"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">
                                    <button type="submit" id="addTempReceiveMainTransaction" class="btn btn-success addButton">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
