$(document).ready(function () {
    /////////////// ------------------ Search category by name and add value to input ajax part start ---------------- /////////////////////////////
    //search category on add modal
    $(document).on('keyup', '#category', function () {
        let category = $(this).val();
        $('#category').removeAttr('data-id');
        getCategoryByName(category, '#category-list ul');
    });

    //add list value in category input of add modal
    $(document).on('click', '#category-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#category').val(value);
        $('#category').attr('data-id', id);
        $('#category-list ul').html('');
    });

    //search category on edit modal
    $(document).on('keyup', '#updateCategory', function () {
        let category = $(this).val();
        $('#updateCategory').removeAttr('data-id');
        getCategoryByName(category, '#update-category ul');
    });


    //add list value in category input of add modal
    $(document).on('click', '#update-category li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateCategory').val(value);
        $('#updateCategory').attr('data-id', id);
        $('#update-category ul').html('');
    });



    //search product by name
    function getCategoryByName(category, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getCategoryByName",
            method: 'get',
            data: {category:category},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search category by name and add value to input ajax part end ---------------- /////////////////////////////
    


    /////////////// ------------------ Search Location by Division name and add value to input ajax part start ---------------- /////////////////////////////
    //Search Location on add modal
    $(document).on('keyup', '#location', function () {
        let location = $(this).val();
        $('#location').removeAttr('data-id');
        getLocationByDivision(location, '#location-list ul');
    });

    //Add list value in location input of add modal
    $(document).on('click', '#location-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#location').val(value);
        $('#location').attr('data-id', id);
        $('#location-list ul').html('');
    });

    //Search Location on edit modal
    $(document).on('keyup', '#updateLocation', function () {
        let category = $(this).val();
        $('#updateLocation').removeAttr('data-id');
        getLocationByDivision(category, '#update-location ul');
    });


    //Add list value in location input of add modal
    $(document).on('click', '#update-location li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateLocation').val(value);
        $('#updateLocation').attr('data-id', id);
        $('#update-location ul').html('');
    });



    //Search Location by Division
    function getLocationByDivision(location, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getLocationByDivision",
            method: 'get',
            data: {location:location},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Location by Division name and add value to input ajax part end ---------------- /////////////////////////////
    
   
});