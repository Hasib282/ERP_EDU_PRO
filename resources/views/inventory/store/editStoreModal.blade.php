<div id="editStoreModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Store</h3>
            <span class="close-modal" data-modal-id="editStoreModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Store</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="EditStoreForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <input type="hidden" name="id" class="form-control" id="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="updateStoreName">Store Name</label>
                                <input type="text" name="storeName" class="form-control" id="updateStoreName">
                                <span class="text-danger error" id="update_storeName_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="updateLocation">Location:</label>
                                <input type="text" name="location" class="form-control" id="updateLocation" autocomplete="off">
                                <div id="update-location">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="update_location_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="updateStatus">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="updateStore">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
