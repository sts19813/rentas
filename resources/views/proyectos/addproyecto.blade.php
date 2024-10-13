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
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
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
            font-size: .875rem;
            font-weight: 500;
            color: #28a745;
        }

        .navbar {
            padding: .8rem 1rem;
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-right: 1rem;
        }

        .navbar-brand {
            color: #5cb85c;
        }

        #reglamento,
        #terminos {
            height: 175px;
        }
    </style>
</head>

<body>
    <x-header></x-header>
    <div class="container mt-5">
        <div class="content w-100">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Proyecto</h2>
            </div>



            <div class="container mt-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                data-bs-target="#general" type="button" role="tab" aria-controls="general"
                                aria-selected="true">General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="caracteristicas-tab" data-bs-toggle="tab"
                                data-bs-target="#caracteristicas" type="button" role="tab"
                                aria-controls="caracteristicas" aria-selected="false">Características</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="unidades-tab" data-bs-toggle="tab" data-bs-target="#unidades"
                                type="button" role="tab" aria-controls="unidades"
                                aria-selected="false">Unidades</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="mapa-tab" data-bs-toggle="tab" data-bs-target="#mapa"
                                type="button" role="tab" aria-controls="mapa" aria-selected="false">Mapa</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reglas-tab" data-bs-toggle="tab" data-bs-target="#reglas"
                                type="button" role="tab" aria-controls="reglas"
                                aria-selected="false">Reglas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="multimedia-tab" data-bs-toggle="tab"
                                data-bs-target="#multimedia" type="button" role="tab" aria-controls="multimedia"
                                aria-selected="false">Multimedia</button>
                        </li>
                    </ul>

                    <!-- Formulario completo -->
                    <form action="{{ route('proyectos.store') }}" method="POST" id="formGuardarProyecto">
                        @csrf
                        <div class="tab-content" id="myTabContent">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                aria-labelledby="general-tab">
                                <div class="container">
                                    <h6>Información de la Plaza</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombrePlaza" class="form-label">Nombre de la plaza *</label>
                                            <input type="text" class="form-control" id="nombrePlaza"
                                                name="nombrePlaza">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cantidadLocales" class="form-label">Cantidad de Locales
                                                *</label>
                                            <input type="number" class="form-control" id="cantidadLocales"
                                                name="cantidadLocales">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cantidadCajones" class="form-label">Cantidad Cajones de
                                                Estacionamiento *</label>
                                            <input type="number" class="form-control" id="cantidadCajones"
                                                name="cantidadCajones">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="precioRenta" class="form-label">Precio Renta Promedio</label>
                                            <input type="text" class="form-control" id="precioRenta"
                                                name="precioRenta">
                                        </div>
                                    </div>
                                    <!-- Más campos generales -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cuotaMantenimiento" class="form-label">Cuota de Mantenimiento
                                                *</label>
                                            <input type="text" class="form-control" id="cuotaMantenimiento"
                                                name="cuotaMantenimiento">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nivelesPlaza" class="form-label">Niveles de la plaza *</label>
                                            <input type="number" class="form-control" id="nivelesPlaza"
                                                name="nivelesPlaza">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="horaApertura" class="form-label">Hora Apertura *</label>
                                            <input type="time" class="form-control" id="horaApertura"
                                                name="horaApertura">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horaCierre" class="form-label">Hora Cierre *</label>
                                            <input type="time" class="form-control" id="horaCierre"
                                                name="horaCierre">
                                        </div>
                                    </div>
                                    <!-- Ubicación de la Plaza -->
                                    <h6>Ubicación de la Plaza</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="direccion1" class="form-label">Dirección línea 1 *</label>
                                            <input type="text" class="form-control" id="direccion1"
                                                name="direccion1">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="pais" class="form-label">País *</label>
                                            <input type="text" class="form-control" id="pais"
                                                name="pais">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="estado" class="form-label">Estado *</label>
                                            <input type="text" class="form-control" id="estado" name="estado"
                                                value="">

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="ciudad" class="form-label">Ciudad *</label>
                                            <input type="text" class="form-control" id="ciudad" name="ciudad"
                                                value="">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="codigoPostal" class="form-label">Código Postal *</label>
                                            <input type="text" class="form-control" id="codigoPostal"
                                                name="codigoPostal">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Características Tab -->
                            <div class="tab-pane fade" id="caracteristicas" role="tabpanel"
                                aria-labelledby="caracteristicas-tab">
                                <div class="container mt-4">

                                    <!-- Sección de Amenidades -->
                                    <div class="card mb-4" style="display:inline-block; width:49%">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Amenidades</h5>
                                            <button type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-borderless mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Nombre Amenidad</th>
                                                        <th scope="col" class="text-end">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    style="display:table-caption; height:200px; overflow-y: scroll;">
                                                    @foreach ($amenidades as $amenidad)
                                                        <tr>

                                                            <td>
                                                                <label class="form-check-label"
                                                                    for="amenidad{{ $amenidad->id }}">
                                                                    {{ $amenidad->nombre }}
                                                                </label>

                                                            </td>
                                                            <td class="text-end">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="amenidades[]" value="{{ $amenidad->id }}"
                                                                    id="amenidad{{ $amenidad->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Sección de servicios -->
                                    <div class="card mb-4" style="display:inline-block; width:49%">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Servicios</h5>
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                id="btn-servicio">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-borderless mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Nombre del Servicio</th>
                                                        <th scope="col" class="text-end">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    style="display:table-caption; height:200px; overflow-y: scroll;">
                                                    @foreach ($servicios as $servicio)
                                                        <tr>
                                                            <td>
                                                                <label class="form-check-label"
                                                                    for="servicio{{ $servicio->id }}">
                                                                    {{ $servicio->nombre }}
                                                                </label>
                                                            </td>
                                                            <td class="text-end">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="servicios[]" value="{{ $servicio->id }}"
                                                                    id="servicio{{ $servicio->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Unidades Tab -->
                            <div class="tab-pane fade" id="unidades" role="tabpanel"
                                aria-labelledby="unidades-tab">
                                <div class="container mt-4">
                                    <div>
                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-between mt-3">
                                            <a href="/plantillas/Plantilla Unidades.xlsx"
                                                class="btn btn-outline-secondary">Descargar Demo</a>
                                            <div>
                                                <input class="form-control" type="file" id="excelFile">
                                            </div>
                                        </div>

                                        <!-- Unidades Table -->
                                        <div class="table-responsive mt-4">
                                            <table id="unidadesTable" class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>M2</th>
                                                        <th>Precio x Hora</th>
                                                        <th>Precio x Mes</th>
                                                        <th>Precio primer pago</th>
                                                        <th>Nivel</th>
                                                        <th>Estatus</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mapa" role="tabpanel" aria-labelledby="mapa-tab">
                                <div class="container">
                                    <h5 class="card-title">subir mapa</h5>
                                    <!-- Upload Section -->
                                    <div class="card mt-4">
                                        <div class="card-body text-center">
                                            <div>
                                                <h5 class="card-title">Nueva Imagen o Imágenes</h5>
                                                <input class="form-control" type="file" id="mapas"
                                                    name="mapas[]" multiple>
                                            </div>
                                            <div>
                                                <div id="preview" class="mt-2 d-flex flex-wrap"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenido de la pestaña Reglas -->
                            <div class="tab-pane fade" id="reglas" role="tabpanel" aria-labelledby="reglas-tab">

                                <div>
                                    <div class="mb-4">
                                        <label for="reglamento" class="form-label">Reglamento</label>
                                        <div id="reglamento" class="quill-editor"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="terminos" class="form-label">Términos y Condiciones</label>
                                        <div id="terminos" class="quill-editor"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contenido de la pestaña Multimedia -->
                            <div class="tab-pane fade" id="multimedia" role="tabpanel"
                                aria-labelledby="multimedia-tab">
                                <div class="container mt-5">
                                    <!-- Upload Section -->
                                    <div class="card mt-4">
                                        <div class="card-body text-center">
                                            <div>
                                                <h5 class="card-title">sube las imagenes de multimedia</h5>
                                                <input class="form-control" type="file" id="multimedias"
                                                    name="multimedias[]" multiple>
                                            </div>
                                            <div>
                                                <div id="preview-multimedias" class="mt-2 d-flex flex-wrap"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de enviar al final -->
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="/assets/js/proyecto.js"></script>

</body>

</html>
