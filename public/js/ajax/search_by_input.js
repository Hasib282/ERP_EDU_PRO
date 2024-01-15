$(document).ready(function () {
    /////////////// ------------------ Search Unit by name and add value to input ajax part start ---------------- /////////////////////////////
    //search unit on add modal
    $(document).on('keyup', '#unit', function () {
        let unit = $(this).val();
        $('#unit').removeAttr('data-id');
        getUnitByName(unit, '#unit-list ul');
    });

    //add list value in unit input of add modal
    $(document).on('click', '#unit-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#unit').val(value);
        $('#unit').attr('data-id', id);
        $('#unit-list ul').html('');
    });

    //search unit on edit modal
    $(document).on('keyup', '#updateUnit', function () {
        let unit = $(this).val();
        $('#updateUnit').removeAttr('data-id');
        getUnitByName(unit, '#update-unit ul');
    });


    //add list value in unit input of add modal
    $(document).on('click', '#update-unit li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateUnit').val(value);
        $('#updateUnit').attr('data-id', id);
        $('#update-unit ul').html('');
    });



    //search unit by name
    function getUnitByName(unit, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getUnitByName",
            method: 'get',
            data: {unit:unit},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Unit by name and add value to input ajax part end ---------------- /////////////////////////////
    



    /////////////// ------------------ Search Supplier by name and add value to input ajax part start ---------------- /////////////////////////////
    //search Supplier on add modal
    $(document).on('keyup', '#supplier', function () {
        let supplier = $(this).val();
        $('#supplier').removeAttr('data-id');
        getSupplierByName(supplier, '#supplier-list ul');
    });

    //add list value in Supplier input of add modal
    $(document).on('click', '#supplier-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#supplier').val(value);
        $('#supplier').attr('data-id', id);
        $('#supplier-list ul').html('');
    });

    //search Supplier on edit modal
    $(document).on('keyup', '#updateSupplier', function () {
        let supplier = $(this).val();
        $('#updateSupplier').removeAttr('data-id');
        getSupplierByName(supplier, '#update-supplier ul');
    });


    //add list value in Supplier input of add modal
    $(document).on('click', '#update-supplier li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateSupplier').val(value);
        $('#updateSupplier').attr('data-id', id);
        $('#update-supplier ul').html('');
    });



    //search Supplier by name
    function getSupplierByName(supplier, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getSupplierByName",
            method: 'get',
            data: {supplier:supplier},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Supplier by name and add value to input ajax part end ---------------- /////////////////////////////
    



    /////////////// ------------------ Search Manufacturer by name and add value to input ajax part start ---------------- /////////////////////////////
    //search Manufacturer on add modal
    $(document).on('keyup', '#manufacturer', function () {
        let manufacturer = $(this).val();
        $('#manufacturer').removeAttr('data-id');
        getManufacturerByName(manufacturer, '#manufacturer-list ul');
    });

    //add list value in Manufacturer input of add modal
    $(document).on('click', '#manufacturer-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#manufacturer').val(value);
        $('#manufacturer').attr('data-id', id);
        $('#manufacturer-list ul').html('');
    });

    //search Manufacturer on edit modal
    $(document).on('keyup', '#updateManufacturer', function () {
        let manufacturer = $(this).val();
        $('#updateManufacturer').removeAttr('data-id');
        getManufacturerByName(manufacturer, '#update-manufacturer ul');
    });


    //add list value in Manufacturer input of add modal
    $(document).on('click', '#update-manufacturer li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateManufacturer').val(value);
        $('#updateManufacturer').attr('data-id', id);
        $('#update-manufacturer ul').html('');
    });



    //search Manufacturer by name
    function getManufacturerByName(manufacturer, targetElement1) {
        $.ajax({
            url: "/admin/inventory/getManufacturerByName",
            method: 'get',
            data: {manufacturer:manufacturer},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Manufacturer by name and add value to input ajax part end ---------------- /////////////////////////////
    


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
    


    /////////////// ------------------ Search Sub Category by name and add value to input ajax part start ---------------- /////////////////////////////
    //search sub category on add modal
    $(document).on('keyup', '#subCategory', function () {
        let category = $('#category').attr('data-id');
        let subCategory = $(this).val();
        $('#subCategory').removeAttr('data-id');
        getSubCategoryByCategoryId(category, subCategory, '#subCategory-list ul');
    });

    //add list value in sub category input of add modal
    $(document).on('click', '#subCategory-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#subCategory').val(value);
        $('#subCategory').attr('data-id', id);
        $('#subCategory-list ul').html('');
    });

    //search sub category on edit modal
    $(document).on('keyup', '#updateSubCategory', function () {
        let category = $('#updateCategory').attr('data-id');
        let subCategory = $(this).val();
        $('#updateSubCategory').removeAttr('data-id');
        getSubCategoryByCategoryId(category, subCategory, '#update-subCategory ul');
    });


    //add list value in sub category input of add modal
    $(document).on('click', '#update-subCategory li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateSubCategory').val(value);
        $('#updateSubCategory').attr('data-id', id);
        $('#update-subCategory ul').html('');
    });



    //search sub category by category
    function getSubCategoryByCategoryId(category, subCategory, targetElement1) {
        $.ajax({
            url: "/admin/inventory/productSubCategoryByCategory",
            method: 'get',
            data: {category:category, subCategory:subCategory},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Sub Category by name and add value to input ajax part end ---------------- /////////////////////////////
    



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