<div id="editReceiveDetailModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Receive Details</h3>
            <span class="close-modal" data-modal-id="editReceiveDetailModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Receive Details</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="EditReceiveDetailForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" class="form-control" id="id">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateReceive">Receive Date</label>
                                        <input type="text" name="receive" class="form-control" id="updateReceive" disabled>
                                        <span class="text-danger error" id="update_receive_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateInvoice">Invoice No</label>
                                        <input type="text" name="invoice" class="form-control" id="updateInvoice">
                                        <span class="text-danger error" id="update_invoice_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateBatch">Batch No</label>
                                        <input type="text" name="batch" class="form-control" id="updateBatch">
                                        <span class="text-danger error" id="update_batch_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateSupplier">Supplier Name</label>
                                        <input type="text" name="supplier" class="form-control" id="updateSupplier" autocomplete="off">
                                        <div id="update-supplier">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_supplier_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="updateProduct">Product Name</label>
                                        <input type="search" name="product" class="form-control" id="updateProduct" autocomplete="off">
                                        <div id="update-product">
                                            <ul class="list-group">

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_product_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="updateMrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="updateMrp" disabled>
                                        <span class="text-danger error" id="update_mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateExpiry">Expiry Date</label>
                                        <input type="text" name="expiry" class="form-control" id="updateExpiry">
                                        <span class="text-danger error" id="update_expiry_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="updateCp">CP</label>
                                        <input type="text" name="cp" class="form-control" id="updateCp">
                                        <span class="text-danger error" id="update_cp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateDiscount">Discount</label>
                                        <input type="text" name="discount" class="form-control" id="updateDiscount">
                                        <span class="text-danger error" id="update_discount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateQuantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="updateQuantity">
                                        <span class="text-danger error" id="update_quantity_error"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateUser">User id:</label>
                                        <select name="user" class="form-control" id="updateUser">
                                            <option value="">User Name</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error" id="update_user_error"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateStatus">Status:</label>
                                        <select name="status" class="form-control" id="updateStatus">
                                            <option value="">Status</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error" id="update_user_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateReceiveDetail" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="calculation">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <table style="width: 100%">
                                    <tr>
                                        <td><label for="updateTotal">Total:</label></td>
                                        <td><input type="text" name="total" class="form-control" id="updateTotal" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="updateTotalDiscount">Total Discount:</label></td>
                                        <td><input type="text" name="totalDiscount" class="form-control" id="updateTotalDiscount" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="updateNetTotal">Net Total:</label></td>
                                        <td><input type="text" name="netTotal" class="form-control" id="updateNetTotal" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="updatePaid">Advance/Paid:</label></td>
                                        <td><input type="text" name="paid" class="form-control" id="updatePaid"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="updateBalance">Due/Balance:</label></td>
                                        <td><input type="text" name="balance" class="form-control" id="updateBalance" disabled></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
