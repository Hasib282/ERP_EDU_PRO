<div id="editUnitModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Unit</h3>
            <span class="close-modal" data-modal-id="editUnitModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Units</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="EditUnitForm" method="post">
                    @csrf
                    @method('Put')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="unitId" class="form-control" id="updateUnitId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="unitName">Unit Name</label>
                                        <input type="text" name="unitName" class="form-control" id="updateUnitName">
                                        <span class="text-danger" id="update_unitName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="updateStatus">
                                    {{-- options will be display dynamically --}}

                                </select>
                                <span class="text-danger error" id="update_status_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="updateUnit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
