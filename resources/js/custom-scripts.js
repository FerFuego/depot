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

$('#deleteTaskModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var task_id = button.data('taskid')
    var modal = $(this)
    modal.find('form').attr('action','/tasks/'+ task_id)
})

$('#deleteTodoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var todo_id = button.data('todoid')
    var modal = $(this)
    modal.find('form').attr('action','/todos/'+ todo_id)
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

// Select sercheables
$('#select_sucursal').selectpicker();
$('#select_gerent').selectpicker();

//Tables
$("#tableSucursals, #tableSales, #tableRoles, #tableUsers").DataTable({
    "responsive": true,
    "autoWidth": false,
});

//Calendar
$('#calendar').datetimepicker({
    format: 'L',
    inline: true,
    language: 'es',
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
});

//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox();

//TodoList
document.addEventListener('DOMContentLoaded', () => {

    // Select all checkboxes with the name 'settings' using querySelectorAll.
    var checkboxes = document.querySelectorAll("input[type=checkbox][name=task_id]");
    var state = 0;
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.parentElement.classList.add("done");
                state = 1;
            } else {
                this.parentElement.parentElement.classList.remove("done");
                state = 0;
            }

            var attrs = {
                'task_id' : this.value,
                'is_complete' : state
            }
        
            const ops = {
                method: 'PATCH',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs) ,
                url: '/todolists/update'
            };
    
            axios(ops).then(function (response) {
               /*  let content = createHtmlContent( response );
                currentDiv.innerHTML = '';
                currentDiv.append(content); */
            })
    
            .catch(function (error) {
                console.log(error);
            })
        })
    })
})