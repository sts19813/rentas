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

        .img-report{
            max-height: 200px;
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
                            <button class="nav-link" id="unidad-tab" data-bs-toggle="tab" data-bs-target="#unidad"
                                type="button" role="tab" aria-controls="unidad"
                                aria-selected="false">Unidad</button>
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reporte-tab" data-bs-toggle="tab"
                                data-bs-target="#reporte" type="button" role="tab" aria-controls="reporte"
                                aria-selected="false">Reporte</button>
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
                                                <button class="btn btn-success seleccionar-unidad"
                                                    data-id="{{ $proyecto->id }}">Seleccionar y Cotizar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tab content for seleccion de unidad -->
                        <div class="tab-pane fade" id="unidad" role="tabpanel" aria-labelledby="unidad-tab">
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
                                            <th>Primer pago</th>
                                            <th>Nivel</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- Tab content for seleccion de prospecto -->
                        <div class="tab-pane fade" id="prospecto" role="tabpanel" aria-labelledby="prospecto-tab">

                            <br>
                            <h2>Información Personal</h2>
                            <form>

                                <div class="mb-3 d-flex">
                                    <div class="me-2" style="flex: 1;">
                                        <label for="nombre" class="form-label">Nombre *</label>
                                        <input type="text" class="form-control" id="nombre" required>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="apellido" class="form-label">Apellido *</label>
                                        <input type="text" class="form-control" id="apellido" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tipoCliente" class="form-label">Tipo de Cliente *</label>
                                    <select class="form-select" id="tipoCliente" required>
                                        <option selected disabled value="">Seleccione...</option>
                                        <option value="persona_fisica">Persona física</option>
                                        <option value="persona_moral">Persona moral</option>
                                    </select>
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="me-2" style="flex: 1;">
                                        <label for="correo" class="form-label">Correo *</label>
                                        <input type="email" class="form-control" id="correo" required>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="celular" class="form-label">Celular *</label>
                                        <input type="tel" class="form-control" id="celular" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        id="nextTabButton">Siguiente</button>
                                </div>
                            </form>

                        </div>
                        <!-- Tab content for Cotización -->
                        <div class="tab-pane fade" id="cotizacion" role="tabpanel" aria-labelledby="cotizacion-tab">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="precioRenta" class="form-label">Precio de Renta *</label>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputmesRenta" class="col-form-label">Mes</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" id="inputmesRenta" class="form-control"
                                                    aria-describedby="passwordHelpInline" disabled >
                                            </div>
                                            <div class="col-auto">
                                                <label for="inputRentaHr" class="col-form-label">Hr</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" id="inputRentaHr" class="form-control"
                                                    aria-describedby="passwordHelpInline" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="primerPago" class="form-label">Primer Pago *</label>
                                        <input type="text" class="form-control" id="primerPago" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="precioRenta" class="form-label">Tiempo *</label>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputmesRenta" class="col-form-label">Periodo:</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" id="inputTiempoCotizacion" class="form-control"
                                                    aria-describedby="passwordHelpInline">
                                            </div>
                                            <div class="col-auto">
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select" id="tiempo">
                                                    <option selected>años</option>
                                                    <option selected>horas</option>
                                                    <option selected>meses</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fechaInicio" class="form-label">Fecha Inicio *</label>
                                        <input type="datetime-local" class="form-control" id="primerPago" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <span>cotización aproximada de todo el periodo de renta <span id="Txtcotizacion">100</span></span>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12" id="contenedorServicios">
                                       
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button id="nextTabButtonReporte" class="btn btn-primary">Siguiente</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
                            <div class="container">

                                <div class="container my-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Cotización: <span id="nombreCotizacion"> David Sabido</span>   </h3>
                                        </div>
                                    </div>
                                    <div class="row align-items-start">
                                        <div class="col-md-2 text-center">
                                            <img src="/media/logos/logo.svg" alt="Logo" class="img-fluid mb-3">
                                            <p>LOGO</p>
                                        </div>
                                        <div class="col-md-5">
                                            <img src="#" id="mapaCotizacion"  alt="Imagen Plaza" class="img-fluid mb-3 img-report">
                                        </div>
                                        <div class="col-md-5">
                                            <img src="#" id="mapaMultimedia" alt="Mapa Plaza" class="img-fluid mb-3 img-report">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Plaza:</strong> <span id="namePlaza"> </span></p>
                                            <p><strong>Unidad:</strong> <span id="nombreUnidad"> </span></p>
                                            <p><strong>Precio de Renta mes:</strong> $ <span id="PrecioRentaMes"> </span> </p>
                                            <p><strong>Precio de Renta hr:</strong> $ <span id="PrecioRentaHr"> </span> </p>
                                            <p><strong>Primer Pago:</strong> $ <span id="primerPagoC"> </span>  </p>
                                            <p><strong>Tiempo de Renta:</strong><span id="tiempoRentaC"> </span>  1 año</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><strong>Horarios:</strong></p>
                                            <ul class="list-unstyled">
                                                <li><strong>hora Apertura:</strong> <span id="horaApertura"> </span> </li>
                                                <li><strong>hora cierre:</strong> <span id="horaCierre"> </span> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h5>Incluye:</h5>
                                            <ul class="list-unstyled" id="contenedorServicios2">
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary">enviar correo</button>
                                        </div>
                                        <div class="col-auto text-center">
                                            <button type="button" class="btn btn-success">descargar</button>
                                        </div>
                                        <div class="col-auto text-right">
                                            <button type="button" class="btn btn-warning">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                               
                            </div>

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
