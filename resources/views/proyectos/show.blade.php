<div class="container mt-5">
    <h2>{{ $proyecto->nombre }}</h2>

    <div class="row mb-4">
        <div class="col-md-12">
            @if($proyecto->mapas->isNotEmpty())
                <img src="{{ Storage::url($proyecto->mapas->first()->ruta_imagen) }}" alt="{{ $proyecto->nombre }}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/800x400" alt="Imagen por defecto" class="img-fluid">
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4>Unidades</h4>
            <ul>
                @foreach($proyecto->unidades as $unidad)
                    <li>{{ $unidad->nombre }} - {{ $unidad->metros_cuadrados }} m² - {{ $unidad->estatus }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Amenidades</h4>
            <ul>
                @foreach($proyecto->amenidades as $amenidad)
                    <li>{{ $amenidad->nombre }}</li>
                @endforeach
            </ul>

            <h4>Servicios</h4>
            <ul>
                @foreach($proyecto->servicios as $servicio)
                    <li>{{ $servicio->nombre }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
