@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardFinanciamientos" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardFinanciamientos">
        <h6 class="m-0 font-weight-bold text-primary">Registro de financiamientos</h6>
    </a>

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardFinanciamientos">
        <div class="card-body">
            <h5>Nuevo Financiamiento</h5>

            <form action="/financiamientos" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="fuente" class="form-label">Nombre de Fuente de Financiamiento</label>
                        <input type="text" class="form-control" name="fuente" id="fuente" placeholder="Ingresa el nombre de la fuente" maxlength="50" required>
                    </div>
                </div>

                <a href="/financiamientos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

            <div class="row mt-3">
                <div class="col-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection