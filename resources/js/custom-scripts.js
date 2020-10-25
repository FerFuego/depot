$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var user_id = button.data('userid')
    var modal = $(this)
    /* modal.find('.modal-footer #user_id').val(user_id) */
    modal.find('form').attr('action','/users/'+ user_id)
})