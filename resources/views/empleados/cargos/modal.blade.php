<form action="/cargos/{{$cargo->id}}" method="post">
    @csrf
    @method('DELETE')
    <!-- Modal -->
     <div class="modal fade" id="cargo-modal-{{$cargo->id}}" tabindex="-1" role="dialog" aria-labelledby="cargo-modal-{{$cargo->id}}"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cargo-modal-{{$cargo->id}}">Mensaje de confimación</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Estas seguro de eliminar este cargo?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">De Acuero</button>
                </div>
            </div>
        </div>
    </div>
</form>