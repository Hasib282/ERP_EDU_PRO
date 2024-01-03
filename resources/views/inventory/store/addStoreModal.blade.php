<div id="addStoreModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Store</h3>
            <span class="close-modal" data-modal-id="addStoreModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Store</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="AddStoreForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="storeName">Store Name</label>
                                <input type="text" name="storeName" class="form-control" id="storeName">
                                <span class="text-danger error" id="storeName_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="location">Location:</label>
                                <select name="location" class="form-control" id="location">
                                    <option value="">Location</option>
                                    @foreach ($inv_location as $location)
                                        <option value="{{ $location->id }}">{{ $location->district_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="location_error"></span>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="addStore">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
