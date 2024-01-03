<div id="editManufacturerModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Manufacturer</h3>
            <span class="close-modal" data-modal-id="editManufacturerModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Manufacturer</h3>
                    </div>
                </div>

                <form id="EditManufacturerForm" method="post">
                    @csrf 
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control"  id="id">
                            <div class="form-group">
                                <label for="updateManufacturerName">Manufacturer Name</label>
                                <input type="text" name="manufacturerName" class="form-control"  id="updateManufacturerName">
                                <span class="text-danger error" id="update_manufacturerName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateManufacturerEmail">Manufacturer Email</label>
                                <input type="text" name="manufacturerEmail" class="form-control"  id="updateManufacturerEmail">
                                <span class="text-danger error" id="update_manufacturerEmail_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="updateManufacturerContact">Manufacturer Contact</label>
                                <input type="text" name="manufacturerContact" class="form-control"  id="updateManufacturerContact">
                                <span class="text-danger error" id="update_manufacturerContact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateUser">User id:</label>
                                <select name="user" class="form-control" id="updateUser">
                                    <option value="">User id</option>
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_user_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    <option value="">Status</option>
                                    {{-- options will be display dynamically --}}
                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateManufacturer" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

