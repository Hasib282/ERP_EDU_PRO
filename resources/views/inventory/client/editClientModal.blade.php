<div id="editClientModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Client</h3>
            <span class="close-modal" data-modal-id="editClientModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Client</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="EditClientForm" method="POST">
                    @csrf
                    @method('Put')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control" id="id">
                            <div class="form-group">
                                <label for="updateClientName">Client Name</label>
                                <input type="text" name="clientName" class="form-control" id="updateClientName">
                                <span class="text-danger error" id="update_clientName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateContact">Contact</label>
                                <input type="text" name="contact" class="form-control" id="updateContact">
                                <span class="text-danger error" id="update_contact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateUser">User:</label>
                                <select name="user" class="form-control" id="updateUser">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_user_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateStatus">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="editClient">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
