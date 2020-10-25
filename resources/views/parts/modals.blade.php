<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estas seguro q deseas eliminar el usuario?</h5>
                <button class="close" type="button" data-dismiss="modal" arial-label="Close">
                    <span arial-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Presiona "Eliminar" si estas seguro lo que estas haciendo, esta operacion es irreversible.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    @method('delete')
                    @csrf
                    {{-- <input type="hidden" name="user_id" id="user_id" value=""> --}}
                    <button class="btn btn-danger" onclick="$(this).closest('form').submit();"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>