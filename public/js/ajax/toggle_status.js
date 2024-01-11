$(document).ready(function(){
    $(document).on('click', '.toggle-status', function () {
        let table_name = $(this).data('table');
        let id = $(this).data('id');
        let status = $(this).data('status');
        let target = $(this).data('target');
        let currentpage = $('.pagination span').text();
        console.log(currentpage)
        toggleStatus(table_name, id, status, target);
    });

    function toggleStatus(table_name, id, status, targetElement) {
        $.ajax({
            url:"/admin/inventory/status",
            method:'put',
            data:{table_name:table_name,id:id,status:status},
            success:function (res) {
                if(res.status == 'success'){
                    $(targetElement).load(location.href + ' ' + targetElement);
                }
            }
        });
    }
});