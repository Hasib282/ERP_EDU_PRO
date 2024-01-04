$(document).ready(function () {

    /////////////// ------------------ Add Unit ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addUnit', function (e) {
        e.preventDefault();
        let unitName = $('#unitName').val();
        $.ajax({
            url: "/admin/inventory/insertUnits",
            method: 'post',
            data: { unitName: unitName },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addUnitModal').hide();
                    $('#AddUnitForm')[0].reset();
                    $('.unit').load(location.href + ' .unit');
                    toastr.success('Unit Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    /////////////// ------------------ Edit Unit ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editUnitModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editUnits/${id}`,
            method: 'get',
            success: function (res) {
                $('#updateUnitId').val(res.inv_unit.id);
                $('#updateUnitName').val(res.inv_unit.unit_name);

                // Create options dynamically based on the status value
                $('#updateStatus').append(`<option value="1" ${res.inv_unit.status === 1 ? 'selected' : ''}>Active</option>
                                        <option value="0" ${res.inv_unit.status === 0 ? 'selected' : ''}>Inactive</option>`);
                
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



    /////////////// ------------------ Update Unit ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateUnit', function (e) {
        e.preventDefault();
        let id = $('#updateUnitId').val();
        let unitName = $('#updateUnitName').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateUnits/${id}`,
            method: 'Put',
            data: { unitName: unitName, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editUnitModal').hide();
                    $('#EditUnitForm')[0].reset();
                    $('.unit').load(location.href + " .unit")
                    toastr.success('Unit Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Unit ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteUnit', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Unit ??')) {
            $.ajax({
                url: `/admin/inventory/deleteUnits/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.unit').load(location.href + " .unit");
                        toastr.success('Unit Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/unit/pagination?page=${page}`,
            success: function (res) {
                $('.unit').html(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchUnits`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.unit').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.unit').html(res.data);
                }
            }
        });
    });




    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: `/admin/inventory/unit/searchPagination?page=${page}`,
            data:{search:search},
            success: function (res) {
                if (res.status == "null") {
                    $('.unit').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.unit').html('')
                    $('.unit').html(res.data);
                }
            }
        });
    });

});