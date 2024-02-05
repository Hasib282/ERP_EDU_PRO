<div id="editTempTransactionModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Temp Transactions</h3>
            <span class="close-modal" data-modal-id="editTempTransactionModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Temp Transactions</h3>
                    </div>
                </div>

                <form id="EditTempTransactionForm" method="post">
                    @csrf 
                    <div class="center">
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="supplierName">Supplier Name</label>
                                <input type="text" name="supplierName" class="form-control"  id="supplierName">
                                <span class="text-danger error" id="supplierName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="supplierEmail">Supplier Email</label>
                                <input type="text" name="supplierEmail" class="form-control"  id="supplierEmail">
                                <span class="text-danger error" id="supplierEmail_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="supplierContact">Supplier Contact</label>
                                <input type="text" name="supplierContact" class="form-control"  id="supplierContact">
                                <span class="text-danger error" id="supplierContact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="supplierAddress">Supplier Address</label>
                                <input type="text" name="supplierAddress" class="form-control"  id="supplierAddress">
                                <span class="text-danger error" id="supplierAddress_error"></span>
                            </div> --}}
                            <div class="form-group">
                                <label for="user">User id:</label>
                                <select name="user" class="form-control" id="user">

                                </select>
                                <span class="text-danger error" id="user_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="editTempTransaction" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


