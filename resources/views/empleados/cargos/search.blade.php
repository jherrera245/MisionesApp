<form action="/cargos" method="get">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
            <span class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </span>
        </div>
    </div>
</form>