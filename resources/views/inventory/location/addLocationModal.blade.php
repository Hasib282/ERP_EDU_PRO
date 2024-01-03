<div id="addLocationModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Location</h3>
            <span class="close-modal" data-modal-id="addLocationModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Location</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="AddLocationForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="division">Division Name</label>
                                        <input type="text" name="division" class="form-control" id="division">
                                        <span class="text-danger error" id="division_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">District Name</label>
                                        <input type="text" name="district" class="form-control" id="district">
                                        <span class="text-danger error" id="district_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City Name</label>
                                        <input type="text" name="city" class="form-control" id="city">
                                        <span class="text-danger error" id="city_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="road">Road No</label>
                                        <input type="text" name="road" class="form-control" id="road">
                                        <span class="text-danger error" id="road_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="area">Area Name</label>
                                        <input type="text" name="area" class="form-control" id="area">
                                        <span class="text-danger error" id="area"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="addLocation">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
