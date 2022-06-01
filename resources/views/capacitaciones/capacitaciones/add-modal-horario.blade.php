<form action="/horario_capacitacion" method="post">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="horario-add-modal" tabindex="-1" role="dialog" aria-labelledby="horario-add-modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="horario-add-modal">Agregar un horario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" name="capacitacion" type="hidden" value="{{$capacitacion->id}}">

                    <div class="mb-1">
                        <label for="fecha" class="form-label">Fecha de Capacitación</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>

                    <div class="mb-1">
                        <label for="entrada" class="form-label">Hora de entrada</label>
                        <input type="time" name="entrada" class="form-control" required>
                    </div>
                    
                    <div class="mb-1">
                        <label for="saldia" class="form-label">Hora de entrada</label>
                        <input type="time" name="salida" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>