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
    
    
    
    /////////////// ------------------ Search category by name and add value to input ajax part end ---------------- /////////////////////////////
});