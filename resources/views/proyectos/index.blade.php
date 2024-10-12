<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-dark {
            background-color: #111;
        }

        .project-card {
            border-radius: 8px;
            border: 1px solid #eaeaea;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .project-card img {
            border-radius: 8px 8px 0 0;
            object-fit: cover;
            width: 100%;
            height: 200px;
        }

        .project-card .card-body {
            text-align: center;
        }

        .project-card .card-title {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .project-card .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        .project-card .status {
            font-size: 0.875rem;
            font-weight: 500;
            color: #28a745;
        }

        .navbar {
            padding: 0.8rem 1rem;
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-right: 1rem;
        }

        .navbar-brand {
            color: #5cb85c;
        }
    </style>
</head>

<body>
    <x-header />

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
                        <img src="https://via.placeholder.com/400x200" alt="Imagen por defecto" class="card-img-top">
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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>