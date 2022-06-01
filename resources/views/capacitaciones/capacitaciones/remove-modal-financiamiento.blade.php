<form action="/financiamiento_capacitacion/{{$financiamiento->id}}" method="post">
    @csrf
    @method('DELETE')
    <!-- Modal -->
    <div class="modal fade" id="financiamiento-remove-modal-{{$financiamiento->id}}" tabindex="-1" role="dialog" aria-labelledby="financiamiento-remove-modal-{{$financiamiento->id}}"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="financiamiento-remove-modal-{{$financiamiento->id}}">Quieres remover este financiamiento?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Descripción</strong>:  {{$financiamiento->fuente_financiamiento}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Remover</button>
                </div>
            </div>
        </div>
    </div>
</form>