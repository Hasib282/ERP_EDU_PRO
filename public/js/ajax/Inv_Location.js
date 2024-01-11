$(document).ready(function () {

    /////////////// ------------------ Add Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addLocation', function (e) {
        e.preventDefault();
        let division = $('#division').val();
        let district = $('#district').val();
        let city = $('#city').val();
        let area = $('#area').val();
        let road = $('#road').val();
        $.ajax({
            url: "/admin/inventory/insertLocations",
            method: 'Post',
            data: { division:division, district:district, city:city , area:area, road:road },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addLocationModal').hide();
                    $('#AddLocationForm')[0].reset();
                    $('.location').load(location.href + ' .location');
                    toastr.success('Location Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                console.log(err)
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    ///////////// ------------------ Edit location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editLocationModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editLocations/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_location.id);
                $('#updateDivision').val(res.inv_location.division);
                $('#updateDistrict').val(res.inv_location.district_name);
                $('#updateCity').val(res.inv_location.city_name);
                $('#updateArea').val(res.inv_location.area);
                $('#updateRoad').val(res.inv_location.road_no);

                // Create options dynamically based on the status value
                $('#updateStatus').empty()
                $('#updateStatus').append(`<option value="1" ${res.inv_location.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_location.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
                var modal = document.getElementById(modalId);

                if (modal) {
                    modal.style.display = 'block';
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateLocation', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let division = $('#updateDivision').val();
        let district = $('#updateDistrict').val();
        let city = $('#updateCity').val();
        let area = $('#updateArea').val();
        let road = $('#updateRoad').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateLocations/${id}`,
            method: 'Put',
            data: { division: division, district:district, city: city, area:area, road:road, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editLocationModal').hide();
                    $('#EditLocationForm')[0].reset();
                    $('.location').load(location.href + ' .location');
                    toastr.success('Location Updated Successfully', 'Updated!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#update_' + key + "_error").text(value);
                })
            }
        });
    });



    /////////////// ------------------ Delete Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteLocation', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Location ??')) {
            $.ajax({
                url: `/admin/inventory/deleteLocations/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.location').load(location.href + ' .location');
                        toastr.success('Location Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadLocationData(`/admin/inventory/location/pagination?page=${page}`, {}, '.location');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadLocationData(`/admin/inventory/searchLocations`, {search:search}, '.location');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadLocationData(`/admin/inventory/location/searchPagination?page=${page}`, {search:search}, '.location');
    });



    //Location data load function
    function loadLocationData(url, data, targetElement) {
        $.ajax({
            url: url,
            data: data,
            success: function (res) {
                if (res.status == "null") {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                } else {
                    $(targetElement).html(res.data);
                }
            }
        });
    }

});