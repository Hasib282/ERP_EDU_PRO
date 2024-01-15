@section('style')
    <style>
        .modal-subject {
            width: 65%;
        }
        ul li{
            list-style: none;
        }
    </style>
@endsection

<div id="addReceiveDetailModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Receive Details</h3>
            <span class="close-modal" data-modal-id="addReceiveDetailModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Receive Details</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddReceiveDetailForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="receive">Receive Date</label>
                                        <input type="text" name="receive" class="form-control" id="receive" value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="receive_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="invoice">Invoice No</label>
                                        <input type="text" name="invoice" class="form-control" id="invoice">
                                        <span class="text-danger error" id="invoice_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="batch">Batch No</label>
                                        <input type="text" name="batch" class="form-control" id="batch">
                                        <span class="text-danger error" id="batch_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="supplier">Supplier Name</label>
                                        <input type="text" name="supplier" class="form-control" id="supplier" autocomplete="off">
                                        <div id="supplier-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="supplier_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product">Product Name</label>
                                        <input type="search" name="product" class="form-control" id="product" autocomplete="off">
                                        <div id="product-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="product_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="mrp" disabled>
                                        <span class="text-danger error" id="mrp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="expiry">Expiry Date</label>
                                        <input type="date" name="expiry" class="form-control" id="expiry">
                                        <span class="text-danger error" id="expiry_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cp">CP</label>
                                        <input type="text" name="cp" class="form-control" id="cp">
                                        <span class="text-danger error" id="cp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" name="discount" class="form-control" id="discount">
                                        <span class="text-danger error" id="discount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity">
                                        <span class="text-danger error" id="quantity_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">User id:</label>
                                        <select name="user" class="form-control" id="user">
                                            <option value="">User id</option>
                                            @foreach ($user_info as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger error" id="user_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="addReceiveDetail" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                    <div class="calculation">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <table style="width: 100%">
                                    <tr>
                                        <td><label for="total">Total:</label></td>
                                        <td><input type="text" name="total" class="form-control" id="total" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="totalDiscount">Total Discount:</label></td>
                                        <td><input type="text" name="totalDiscount" class="form-control" id="totalDiscount" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="netTotal">Net Total:</label></td>
                                        <td><input type="text" name="netTotal" class="form-control" id="netTotal" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label for="paid">Advance/Paid:</label></td>
                                        <td><input type="text" name="paid" class="form-control" id="paid"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="balance">Due/Balance:</label></td>
                                        <td><input type="text" name="balance" class="form-control" id="balance" disabled></td>
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
