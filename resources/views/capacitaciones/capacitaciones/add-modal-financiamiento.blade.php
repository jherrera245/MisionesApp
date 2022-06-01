<form action="/financiamiento_capacitacion" method="post">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="financiamiento-add-modal" tabindex="-1" role="dialog" aria-labelledby="financiamiento-add-modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="financiamiento-add-modal">Agregar un financiamiento</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="financiamientos" class="form-label">Selecciona los financiamientos</label>
                    <input class="form-control" name="capacitacion" type="hidden" value="{{$capacitacion->id}}">
                    <select name="financiamiento" id="financiamiento" class="form-control">
                    @foreach($financiamientos as $financiamiento)
                        <option value="{{$financiamiento->id}}">{{$financiamiento->fuente_financiamiento}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>