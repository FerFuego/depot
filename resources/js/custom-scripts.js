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

$('#deleteOfferModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var offer_id = button.data('offerid')
    var modal = $(this)
    modal.find('form').attr('action','/offers/'+ offer_id)
})

$('#deleteRRhhModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var rrhh_id = button.data('rrhhid')
    var modal = $(this)
    modal.find('form').attr('action','/rrhhs/'+ rrhh_id)
})

$("#roles_permissions").tagsinput('items')

$(document).ready(function () {
    
    var permissions_box = $('#permissions_box')
    var permissions_checkbox_list = $('#permissions_checkbox_list')
    
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

// Mark as readW
document.addEventListener('DOMContentLoaded', () => {

    // Select all cta with the name 'settings' using querySelectorAll.
    var ctas = document.querySelectorAll(".js-read");

    ctas.forEach(function(cta) {
        cta.addEventListener('click', function() {

            var id = $(this).attr('data-notificationid')

            var attrs = {
                'notification_id' : id,
                'state' : 1
            }

            const ops = {
                method: 'PATCH',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs) ,
                url: '/notifications/' + id
            };

            axios(ops).then(function (response) {
                $('#js-read-'+id).html('Leida');
            })

            .catch(function (error) {
                console.log(error);
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

//TodoList check
document.addEventListener('DOMContentLoaded', () => {

    // Select all checkboxes with the name 'settings' using querySelectorAll.
    var checkboxes = document.querySelectorAll("input[type=checkbox][name=task_id]");
    var is_complete = 0;
    var state = '';
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.parentElement.classList.add("done");
                is_complete = 1;
                state = 'Completada';
            } else {
                this.parentElement.parentElement.classList.remove("done");
                is_complete = 0;
                state = 'Incompleta';
            }

            var attrs = {
                'task_id' : this.value,
                'state' : state,
                'is_complete' : is_complete
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

//TodoList state
document.addEventListener('DOMContentLoaded', () => {

    // Select all cta with the name 'settings' using querySelectorAll.
    var ctas = document.querySelectorAll(".todo-state");
    var state = '';
    var is_complete = 0;
    ctas.forEach(function(cta) {
        cta.addEventListener('click', function() {

            var process = 'process' + this.getAttribute('data-process');
            var elem = document.getElementById(process);

            if (this.getAttribute('data-state') == '' || this.getAttribute('data-state') == 'Incompleta') {
                state = 'En Proceso';
            } else {
                state = 'Incompleta';
            }

            this.setAttribute('data-state', state);

            var attrs = {
                'task_id' : this.getAttribute('data-id'),
                'state' : state,
                'is_complete' : is_complete
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
                
                if ( response.data.state == 'En Proceso') {
                    elem.classList.add("inline-block");
                    elem.classList.remove("d-none");
                } else {
                    elem.classList.add("d-none");
                    elem.classList.remove("inline-block");
                }
            })
    
            .catch(function (error) {
                console.log(error);
            })
        })
    })
})

// jQuery UI sortable for the todo list
$('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
})

function openPopUp(id) {
    $('#item_' + id).toggleClass('d-none');
}

function setStateBooking(id, state) {
    var attrs = {
        'id' : id,
        'state' : state
    }

    const ops = {
        method: 'POST',
        headers: {
            'content-type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(attrs),
        url: '/bookings/state'
    };

    axios(ops).then(function (response) {
        var classe = (state == 'Completado') ? 'badge-success' : (state == 'Cancelado') ? 'badge-danger' : 'badge-warning';
        $('#'+id).removeClass('badge-success');
        $('#'+id).removeClass('badge-danger');
        $('#'+id).removeClass('badge-warning');
        $('#'+id).removeClass('badge-info');
        $('#'+id).addClass(classe);
    })

    .catch(function (error) {
        console.log(error);
    })
}