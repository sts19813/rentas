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
        <!-- Main content -->
        <div class="content w-100">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Cotizar</h2>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                data-bs-target="#general" type="button" role="tab" aria-controls="general"
                                aria-selected="true">Proyecto</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="prospecto-tab" data-bs-toggle="tab" data-bs-target="#prospecto"
                                type="button" role="tab" aria-controls="prospecto"
                                aria-selected="false">Prospecto</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cotizacion-tab" data-bs-toggle="tab"
                                data-bs-target="#cotizacion" type="button" role="tab" aria-controls="cotizacion"
                                aria-selected="false">Cotización</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab content for Proyecto -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">

                            <br>
                            <h3>seleccione el proyecto a cotizar</h3>
                            <br>
                            <div class="row">
                                @foreach ($proyectos as $proyecto)
                                    <div class="col-md-4">
                                        <div class="card project-card">
                                            <!-- Mostrar la imagen si existe, de lo contrario, una imagen por defecto -->
                                            @if ($proyecto->mapas->isNotEmpty())
                                                <img src="{{ asset($proyecto->mapas->first()->ruta_imagen) }}"
                                                    alt="{{ $proyecto->nombre }}" class="card-img-top">
                                            @else
                                                <img src="https://via.placeholder.com/400x200" alt="Imagen por defecto"
                                                    class="card-img-top">
                                            @endif

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                                                <h6 class="card-subtitle mb-2">{{ $proyecto->unidades->count() }}
                                                    Unidades</h6>

                                                <!-- Lógica para mostrar el estatus -->
                                                <p class="status">
                                                    {{ $proyecto->unidades->where('estatus', 'Rentado')->count() == $proyecto->unidades->count() ? '100% Ocupado' : 'Disponible' }}
                                                </p>

                                                <!-- Enlace al detalle del proyecto -->
                                                <button class="btn btn-success seleccionar-prospecto"
                                                    data-id="{{ $proyecto->id }}">Seleccionar y Cotizar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tab content for Prospecto -->
                        <div class="tab-pane fade" id="prospecto" role="tabpanel" aria-labelledby="prospecto-tab">
                            <br>seleccione una unidad
                            <br>
                            <div class="table-responsive">
                                <table id="unitsTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>M²</th>
                                            <th>Precio por Hora</th>
                                            <th>Precio por Mes</th>
                                            <th>Nivel</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- 
                                        <!-- Datos de ejemplo, reemplazar con datos dinámicos -->
                                        @foreach ($unidades as $unidad)
                                            <tr>
                                                <td>{{ $unidad->nombre }}</td>
                                                <td>{{ $unidad->metros_cuadrados }}</td>
                                                <td>${{ number_format($unidad->precio_por_hora, 2) }}</td>
                                                <td>${{ number_format($unidad->precio_por_mes, 2) }}</td>
                                                <td>{{ $unidad->nivel }}</td>
                                                <td><span
                                                        class="badge status-{{ strtolower($unidad->estatus) }}">{{ $unidad->estatus }}</span>
                                                </td>
                                                <td>
                                                    @foreach ($unidad->servicios as $servicio)
                                                        <li>{{ $servicio->nombre }}</li>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($unidad->amenidades as $amenidad)
                                                        <li>{{ $amenidad->nombre }}</li>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm">Seleccionar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        --}}
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- Tab content for Cotización -->
                        <div class="tab-pane fade" id="cotizacion" role="tabpanel" aria-labelledby="cotizacion-tab">
                            <!-- Contenido vacío para Cotización -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="/assets/js/cotizador.js"></script>

    <script>
        $(document).ready(function() {
            $('#clientsTable').DataTable({
                "pageLength": 8,
                "lengthChange": false,
                "order": [
                    [1, "asc"]
                ]
            });
        });
    </script>

</body>

</html>
