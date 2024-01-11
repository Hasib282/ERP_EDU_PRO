<div id="editLocationModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Location</h3>
            <span class="close-modal" data-modal-id="editLocationModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Location</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="EditLocationForm" method="POST">
                    @csrf
                    @method('Put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" class="form-control" id="id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateDivision">Division Name</label>
                                        <input type="text" name="division" class="form-control" id="updateDivision">
                                        <span class="text-danger error" id="update_division_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateDistrict">District Name</label>
                                        <input type="text" name="district" class="form-control" id="updateDistrict">
                                        <span class="text-danger error" id="update_district_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateCity">City Name</label>
                                        <input type="text" name="city" class="form-control" id="updateCity">
                                        <span class="text-danger error" id="update_city_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateRoad">Road No</label>
                                        <input type="text" name="road" class="form-control" id="updateRoad">
                                        <span class="text-danger error" id="update_road_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateArea">Area Name</label>
                                        <input type="text" name="area" class="form-control" id="updateArea">
                                        <span class="text-danger error" id="update_area_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateStatus">Status:</label>
                                    <select name="status" class="form-control" id="updateStatus">
                                        {{-- options will be display dynamically --}}
                                    </select>
                                    <span class="text-danger error" id="update_status_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="updateLocation">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
