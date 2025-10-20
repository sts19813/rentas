@extends('layouts.admin')

@section('content')

<x-link></x-link>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Proyectos</h2>

        <a type="button" class="btn btn-dark" href="/proyectos/create">
            + Nuevo proyecto
        </a>
    </div>

    <div class="row">
        @foreach($proyectos as $proyecto)
        <div class="col-md-4">
            <div class="card project-card">
                <!-- Mostrar la imagen si existe, de lo contrario, una imagen por defecto -->
                @if($proyecto->mapas->isNotEmpty())
                <img src="{{ asset($proyecto->mapas->first()->ruta_imagen) }}" alt="{{ $proyecto->nombre }}" class="card-img-top">
                @else
                <img src="#" alt="Imagen por defecto" class="card-img-top">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                    <h6 class="card-subtitle mb-2">{{ $proyecto->unidades->count() }} Unidades</h6>

                    <!-- Puedes agregar lógica para mostrar el estatus -->
                    <p class="status">
                        {{ $proyecto->unidades->where('estatus', 'Rentado')->count() == $proyecto->unidades->count() ? '100% Ocupado' : 'Disponible' }}
                    </p>

                    <!-- Enlace al detalle del proyecto -->
                    <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

   
@endsection
