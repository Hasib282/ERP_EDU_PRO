@section('style')
    <style>
        .modal-subject {
            width: 90%;
        }
    </style>
@endsection

<div id="editTempReceiveTransactionModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Temp Transactions</h3>
            <span class="close-modal" data-modal-id="editTempReceiveTransactionModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <form id="EditReceiveTransactionForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="updateTranDate">Date</label>
                                    <input type="text" name="tranDate" class="input-small" id="updateTranDate" disabled>
                                    <span class="text-danger error" id="tranDate_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateTranType">Transaction Type</label>
                                    <select name="tranType" class="select-small" id="updateTranType" disabled>
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
                                    <label for="updateTranId">Transaction Id</label>
                                    <input type="text" name="tranId" class="input-small" id="updateTranId">
                                    <span class="text-danger error" id="tranId_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateInvoice">Invoice No</label>
                                    <input type="text" name="invoice" class="input-small" id="updateInvoice">
                                    <span class="text-danger error" id="invoice_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="updateStore">Store</label>
                                    <input type="text" name="store" class="input-small" id="updateStore" autocomplete="off">
                                    <div id="update-store">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="store_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="updateLocation">Location</label>
                                    <input type="text" name="location" class="input-small" id="updateLocation" disabled>
                                    <span class="text-danger error" id="location_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="updateSupplier">Supplier</label>
                                    <input type="text" name="supplier" class="input-small" id="updateSupplier" autocomplete="off">
                                    <div id="update-supplier">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="supplier_error"></span>
                                </div>

                                <div class="col-md-4">
                                    <label for="updateProduct">Product</label>
                                    <input type="text" name="product" class="input-small" id="updateProduct" autocomplete="off">
                                    <div id="update-product">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="product_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateCp">Cp</label>
                                    <input type="text" name="cp" class="input-small" id="updateCp">
                                    <span class="text-danger error" id="cp_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateMrp">Mrp</label>
                                    <input type="text" name="mrp" class="input-small" id="updateMrp">
                                    <span class="text-danger error" id="mrp_error"></span>
                                </div>

                                <div class="col-md-2">
                                    <label for="updateReceiveQty">Receive Qty</label>
                                    <input type="text" name="receiveQty" class="input-small" id="updateReceiveQty">
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
                                
                                <div class="col-md-2">
                                    <label for="updateTotCp">Total Cp</label>
                                    <input type="text" name="totCp" class="input-small" id="updateTotCp"
                                        disabled>
                                    <span class="text-danger error" id="totCp_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateTotMrp">Total Mrp</label>
                                    <input type="text" name="totMrp" class="input-small" id="updateTotMrp"
                                        disabled>
                                    <span class="text-danger error" id="totMrp_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="updateDiscount">Discount</label>
                                    <input type="text" name="discount" class="input-small" id="updateDiscount" value="0">
                                    <span class="text-danger error" id="discount_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="updateUser">User id:</label>
                                    <select name="user" class="select-small" id="updateUser">

                                    </select>
                                    <span class="text-danger error" id="user_error"></span>
                                </div>
                                <div class="center">
                                    <button type="submit" id="updateTempReceiveTransaction"
                                        class="btn btn-success editButton">Edit + </button>
                                </div>
                            </div>


                            <div class="row grid">
                                <div class="col-md-8">
                                    <div class="updateTransaction_grid">
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
                                            <td><label for="updateAmount">Invoice Amount</label></td>
                                            <td><input type="text" name="amount" class="input-small" id="updateAmount"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateTotalDiscount">Discount</label></td>
                                            <td><input type="text" name="totalDiscount" class="input-small" id="updateTotalDiscount"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateNetAmount">Net Amount</label>
                                            <td><input type="text" name="netAmount" class="input-small" id="updateNetAmount"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">
                                    <button type="submit" id="updateTempReceiveMainTransaction" class="btn btn-success editButton">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
