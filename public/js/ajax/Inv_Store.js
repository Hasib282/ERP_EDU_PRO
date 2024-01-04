$(document).ready(function () {

    /////////////// ------------------ Add Store ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addStore', function (e) {
        e.preventDefault();
        let storeName = $('#storeName').val();
        let locations = $('#location').val();
        $.ajax({
            url: "/admin/inventory/insertStores",
            method: 'Post',
            data: { storeName:storeName, locations:locations },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addStoreModal').hide();
                    $('#AddStoreForm')[0].reset();
                    $('.store').load(location.href + ' .store');
                    toastr.success('Store Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Stores ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editStoreModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/inventory/editStores/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.inv_store.id);
                $('#updateStoreName').val(res.inv_store.store_name);
                $('#updateLocation').empty();

                // Create options dynamically based on the user value
                $.each(res.inv_location, function(key,location) {
                    $('#updateLocation').append(`<option value="${location.id}" ${res.inv_store.location_id === location.id ? 'selected' : ''}>${location.district_name}</option>`);
                });

                // Create options dynamically based on the status value
                $('#updateStatus').append(`<option value="1" ${res.inv_store.status === 1 ? 'selected' : ''}>Active</option>
                                         <option value="0" ${res.inv_store.status === 0 ? 'selected' : ''}>Inactive</option>`);

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



    /////////////// ------------------ Update Stores ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#editStore', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let storeName = $('#updateStoreName').val();
        let locations = $('#updateLocation').val();
        let status = $('#updateStatus').val();
        $.ajax({
            url: `/admin/inventory/updateStores/${id}`,
            method: 'Put',
            data: { storeName: storeName, locations:locations, status: status },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editStoreModal').hide();
                    $('#EditStoreForm')[0].reset();
                    $('.store').load(location.href + ' .store');
                    toastr.success('Store Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Store ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteStore', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Store ??')) {
            $.ajax({
                url: `/admin/inventory/deleteStores/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.store').load(location.href + ' .store');
                        toastr.success('Store Deleted Successfully', 'Deleted!');
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
            url: `/admin/inventory/store/pagination?page=${page}`,
            success: function (res) {
                $('.store').html(res);
            },
            error:function(res) {
                console.log(res);
            }
        });
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        $.ajax({
            url: `/admin/inventory/searchStores`,
            method: 'Get',
            data: { search: search },
            success: function (res) {
                if (res.status == "null") {
                    $('.store').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.store').html(res.data);
                    $('.paginate').html(res.pagination);
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
            url: `/admin/inventory/store/searchPagination?page=${page}`,
            data:{search:search},
            success: function (res) {
                if (res.status == "null") {
                    $('.store').html(`<span class="text-danger">Result not Found </span>`);
                }
                else {
                    $('.store').html('')
                    $('.store').html(res.data);
                }
            }
        });
    });

});