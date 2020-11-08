$(document).ready(function () {
    $('#role_name').keyup( function (e) {
        var str = $('#role_name').val()
        str = str.replace(/\W+(?!$)/g, '-').toLowerCase() //replace stapces with dash
        $('#role_slug').val(str)
        $('#role_slug').attr('placeholder', str)
    })
})

$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var user_id = button.data('userid')
    var modal = $(this)
    /* modal.find('.modal-footer #user_id').val(user_id) */
    modal.find('form').attr('action','/users/'+ user_id)
})

$('#deleteRolModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var role_id = button.data('roleid')
    var modal = $(this)
    modal.find('form').attr('action','/roles/'+ role_id)
})

$('#deleteSucursalsModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var sucursal_id = button.data('sucursalid')
    var modal = $(this)
    modal.find('form').attr('action','/sucursals/'+ sucursal_id)
})

$('#deleteSaleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var sale_id = button.data('saleid')
    var modal = $(this)
    modal.find('form').attr('action','/sales/'+ sale_id)
})

$("#roles_permissions").tagsinput('items')

$(document).ready(function () {
    var permissions_box = $('#permissions_box')
    var permissions_checkbox_list = $('#permissions_checkbox_list')
    
    //permissions_box.hide()
    
    $('#role').on('change', function () {
        var role = $(this).find(':selected')
        var role_id = role.data('role-id')
        var role_slug = role.data('role-slug')
        permissions_checkbox_list.empty()
        
        $.ajax ({
            url: "/users/create",
            method: 'get',
            dataType: 'json',
            data:  {
                role_id: role_id,
                role_slug: role_slug
            },
        }).done ( function (data) {
            permissions_box.show()
            $.each(data, function(index, element){
                $(permissions_checkbox_list).append(
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" name="permissions[]" class="custom-control-input" id="'+ element.slug +'" value="' + element.id + '">' +
                    '<label for="'+ element.slug +'" class="custom-control-label">' + element.name + '</label>' +
                    '</div>'
                )
            })
        })
    })
});

$('#select_sucursal').selectpicker();
$('#select_gerent').selectpicker();