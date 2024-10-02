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
                <h2>Proyecto</h2>
            </div>

            <!-- Card -->
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
                    <div class="tab-content" id="myTabContent">
                        <!-- Contenido de la pestaña General -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <!-- Contenido del formulario como el de la imagen -->
                            <div class="container">
                                <form>
                                    <!-- Información de la Plaza -->
                                    <h6>Información de la Plaza</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombrePlaza" class="form-label">Nombre de la plaza *</label>
                                            <input type="text" class="form-control" id="nombrePlaza">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cantidadLocales" class="form-label">Cantidad de Locales
                                                *</label>
                                            <input type="number" class="form-control" id="cantidadLocales">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cantidadCajones" class="form-label">Cantidad Cajones de
                                                Estacionamiento
                                                *</label>
                                            <input type="number" class="form-control" id="cantidadCajones">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="precioRenta" class="form-label">Precio Renta Promedio</label>
                                            <input type="text" class="form-control" id="precioRenta">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cuotaMantenimiento" class="form-label">Cuota de Mantenimiento
                                                *</label>
                                            <input type="text" class="form-control" id="cuotaMantenimiento">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nivelesPlaza" class="form-label">Niveles de la plaza *</label>
                                            <input type="number" class="form-control" id="nivelesPlaza">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="horaApertura" class="form-label">Hora Apertura *</label>
                                            <input type="time" class="form-control" id="horaApertura">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horaCierre" class="form-label">Hora Cierre *</label>
                                            <input type="time" class="form-control" id="horaCierre">
                                        </div>
                                    </div>
                                    <!-- Ubicación de la Plaza -->
                                    <h6>Ubicación de la Plaza</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="direccion1" class="form-label">Dirección línea 1 *</label>
                                            <input type="text" class="form-control" id="direccion1">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="pais" class="form-label">País *</label>
                                            <select class="form-select" id="pais">
                                                <option selected>Seleccionar...</option>
                                                <option value="1">México</option>
                                                <!-- Agregar más opciones aquí -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="estado" class="form-label">Estado *</label>
                                            <select class="form-select" id="estado">
                                                <option selected>Seleccionar...</option>
                                                <option value="1">Jalisco</option>
                                                <!-- Agregar más opciones aquí -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="ciudad" class="form-label">Ciudad *</label>
                                            <select class="form-select" id="ciudad">
                                                <option selected>Seleccionar...</option>
                                                <option value="1">Guadalajara</option>
                                                <!-- Agregar más opciones aquí -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="codigoPostal" class="form-label">Código Postal *</label>
                                            <input type="text" class="form-control" id="codigoPostal">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Contenido de la pestaña Características -->
                        <div class="tab-pane fade" id="caracteristicas" role="tabpanel"
                            aria-labelledby="caracteristicas-tab">
                            <div class="container mt-4">
                                <!-- Sección de Amenidades -->
                                <div class="card mb-4">
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
                                            <tbody>
                                                <tr>
                                                    <td>Fuente</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Parque central</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sillas exterior</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Sección de Servicios -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Servicios</h5>
                                        <button type="button" class="btn btn-outline-primary btn-sm">
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
                                            <tbody>
                                                <tr>
                                                    <td>CFE</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Japay</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Internet Público</td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Contenido de la pestaña Unidades -->
                        <div class="tab-pane fade" id="unidades" role="tabpanel" aria-labelledby="unidades-tab">
                            <div>
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-outline-secondary">Descargar Demo</button>
                                    <button class="btn btn-dark">Subir Excel</button>
                                </div>

                                <!-- Unidades Table -->
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>M2</th>
                                                <th>Precio x Hora</th>
                                                <th>Precio x Mes</th>
                                                <th>Nivel</th>
                                                <th>Estatus</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Local 01</td>
                                                <td>120</td>
                                                <td>$250.00</td>
                                                <td>$4,500.00</td>
                                                <td>Planta Baja</td>
                                                <td><span class="badge bg-success">Disponible</span></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-warning btn-sm"><i
                                                            class="bi bi-pencil"></i></button>
                                                    <button class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Local 02</td>
                                                <td>125</td>
                                                <td>$250.00</td>
                                                <td>$4,900.00</td>
                                                <td>Planta Baja</td>
                                                <td><span class="badge bg-warning text-dark">Comprometido</span></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-warning btn-sm"><i
                                                            class="bi bi-pencil"></i></button>
                                                    <button class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Local 03</td>
                                                <td>250</td>
                                                <td>$250.00</td>
                                                <td>$6,900.00</td>
                                                <td>Nivel 02</td>
                                                <td><span class="badge bg-info text-dark">Rentado</span></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button class="btn btn-warning btn-sm"><i
                                                            class="bi bi-pencil"></i></button>
                                                    <button class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Contenido de la pestaña Mapa -->
                        <div class="tab-pane fade" id="mapa" role="tabpanel" aria-labelledby="mapa-tab">
                            <div class="container">
                                <h5 class="card-title">subir mapa</h5>
                                <!-- Upload Section -->
                                <div class="card mt-4">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Nueva Imagen o Imágenes</h5>
                                        <div class="mb-4">
                                            <img src="media/Uploading.svg" alt="Upload Illustration" width="150">
                                        </div>
                                        <p class="card-text">Arrastra un archivo para subir<br>o selecciona uno de tu
                                            computadora</p>
                                        <button class="btn btn-primary">
                                            <i class="bi bi-upload"></i> Subir Archivo
                                        </button>
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
                        <div class="tab-pane fade" id="multimedia" role="tabpanel" aria-labelledby="multimedia-tab">
                            <div class="container mt-5">
                                <!-- Multimedia Section -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Multimedia</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-10">Archivo</th>
                                                    <th class="col-2">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="media/download.jpg" alt="PDF Icon"
                                                                width="40" class="me-2">
                                                            <span>Frente_01.pdf</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm me-2"><i
                                                                class="bi bi-download"></i></button>
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="media/download.jpg" alt="PDF Icon"
                                                                width="40" class="me-2">
                                                            <span>Baño_01.pdf</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm me-2"><i
                                                                class="bi bi-download"></i></button>
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="media/download.jpg" alt="PDF Icon"
                                                                width="40" class="me-2">
                                                            <span>Pasillo_01.pdf</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm me-2"><i
                                                                class="bi bi-download"></i></button>
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Upload Section -->
                                <div class="card mt-4">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Nueva Imagen o Imágenes</h5>
                                        <div class="mb-4">
                                            <img src="media/Uploading.svg" alt="Upload Illustration" width="150">
                                        </div>
                                        <p class="card-text">Arrastra un archivo para subir<br>o selecciona uno de tu
                                            computadora</p>
                                        <button class="btn btn-primary">
                                            <i class="bi bi-upload"></i> Subir Archivo
                                        </button>
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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


    <script>
        var quillReglamento, quillTerminos;

        document.addEventListener('DOMContentLoaded', function() {
            quillReglamento = new Quill('#reglamento', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link']
                    ]
                }
            });

            quillTerminos = new Quill('#terminos', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link']
                    ]
                }
            });
        });

        function saveContent() {
            var reglamentoContent = quillReglamento.root.innerHTML;
            var terminosContent = quillTerminos.root.innerHTML;
            console.log('Reglamento:', reglamentoContent);
            console.log('Términos y Condiciones:', terminosContent);
        }
    </script>

</body>

</html>
