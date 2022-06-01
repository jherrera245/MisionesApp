<form action="/capacitaciones/{{$capacitacion->id}}" method="post">
    @csrf
    @method('PUT')
    <!-- Modal -->
     <div class="modal fade" id="capacitacion-modal-{{$capacitacion->id}}" tabindex="-1" role="dialog" aria-labelledby="capacitacion-modal-{{$capacitacion->id}}"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="capacitacion-modal-{{$capacitacion->id}}">Mensaje de confimación</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Estas seguro de eliminar este capacitacion?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">De Acuero</button>
                </div>
            </div>
        </div>
    </div>
</form>