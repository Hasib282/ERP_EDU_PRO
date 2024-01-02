<div id="addUnitModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Unit</h3>
            <span class="close-modal" data-modal-id="addUnitModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Units</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="AddUnitForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="unitName">Unit Name</label>
                                        <input type="text" name="unitName" class="form-control" id="unitName">
                                        <span class="text-danger error" id="unitName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="addUnit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
