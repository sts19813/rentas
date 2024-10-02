<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-dark {
            background-color: #111;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .status-active {
            background-color: #d1f5d3;
            color: #28a745;
        }

        .status-warning {
            background-color: #fff5cc;
            color: #ffc107;
        }

        .status-danger {
            background-color: #f8d7da;
            color: #dc3545;
        }

        .status-info {
            background-color: #dbe5f1;
            color: #6c757d;
        }

        .features-list {
            list-style-type: none;
            padding-left: 0;
        }

        .features-list li {
            display: flex;
            align-items: center;
        }

        .features-list li::before {
            content: '✔';
            color: #28a745;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <x-header />



    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cotizacion</h2>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                + Nueva Cotizacion
            </button>
        </div>

        <div class="mb-3">
            <button class="btn btn-outline-secondary">Descargar</button>
        </div>

        <div class="table-responsive">
            <table id="clientsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Cliente</th>
                        <th>Negocio</th>
                        <th>Plaza</th>
                        <th>Local</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data, replace with dynamic data -->
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Pristia Candra</td>
                        <td>Miyabi</td>
                        <td>Plaza Árbol</td>
                        <td>Local 02, Local 03</td>
                        <td><span class="badge status-active">Activo</span></td>
                        <td>
                            <button class="btn btn-success btn-sm">Ver</button>
                            <button class="btn btn-primary btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Hanna Baptista</td>
                        <td>El Orden del Caos</td>
                        <td>Plaza Árbol</td>
                        <td>Local 11</td>
                        <td><span class="badge status-warning">Por Vencer</span></td>
                        <td>
                            <button class="btn btn-success btn-sm">Ver</button>
                            <button class="btn btn-primary btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                   
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <!-- Contenido de la pestaña General -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <!-- Contenido del formulario como el de la imagen -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card project-card">
                                            <img src="media/plaza-arbol.png" alt="Plaza Árbol">
                                            <div class="card-body">
                                                <h5 class="card-title">Plaza Árbol</h5>
                                                <h6 class="card-subtitle mb-2">7 Unidades disponibles</h6>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#floorModal">
                                                    seleccionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card project-card">
                                            <img src="https://via.placeholder.com/400x200" alt="Plaza Árbol">
                                            <div class="card-body">
                                                <h5 class="card-title">Plaza Árbol</h5>
                                                <h6 class="card-subtitle mb-2">20 Unidades</h6>
                                                <p class="status">100% Ocupado</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Contenido de la pestaña Características -->
                        <div class="tab-pane fade" id="caracteristicas" role="tabpanel"
                            aria-labelledby="caracteristicas-tab">
                            <div class="container">
                                <div class="form-section">
                                    <h5>Información Personal</h5>
                                    <form>
                                        <!-- Nombre Completo -->
                                        <div class="mb-3">
                                            <label for="nombreCompleto" class="form-label">Nombre Completo <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombreCompleto"
                                                placeholder="Pristia Candra Nelson" required>
                                        </div>

                                        <!-- Tipo de Cliente -->
                                        <div class="mb-3">
                                            <label for="tipoCliente" class="form-label">Tipo de Cliente <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="tipoCliente" required>
                                                <option selected>Persona física</option>
                                                <option value="persona-moral">Persona moral</option>
                                                <option value="otra">Otra</option>
                                            </select>
                                        </div>

                                        <!-- Correo y Celular -->
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label for="correo" class="form-label">Correo <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="correo"
                                                    placeholder="lincoln@gmail.com" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="celular" class="form-label">Celular <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="celular"
                                                    placeholder="089318298493" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- Contenido de la pestaña Unidades -->
                        <div class="tab-pane fade" id="unidades" role="tabpanel" aria-labelledby="unidades-tab">
                            <div>
                                <div class="container">
                                    <div class="form-section">
                                        <h5>Cotización</h5>
                                        <form>
                                            <!-- Precio de Renta y Primer Pago -->
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label for="precioRenta" class="form-label">Precio de Renta <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="precioRenta"
                                                        placeholder="$7,500.00" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="primerPago" class="form-label">Primer Pago <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="primerPago"
                                                        placeholder="$22,500.00" required>
                                                </div>
                                            </div>

                                            <!-- Tiempo -->
                                            <div class="mb-3">
                                                <label for="tiempo" class="form-label">Tiempo <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="tiempo" required>
                                                    <option selected>1 año</option>
                                                    <option value="6 meses">6 meses</option>
                                                    <option value="2 años">2 años</option>
                                                </select>
                                            </div>

                                            <!-- Fecha Inicio -->
                                            <div class="mb-3">
                                                <label for="fechaInicio" class="form-label">Fecha Inicio <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fechaInicio"
                                                    placeholder="01 / Enero / 2023" required>
                                            </div>

                                            <!-- Características -->
                                            <ul class="features-list mb-3">
                                                <li>Baño</li>
                                                <li>Recepción</li>
                                                <li>Dirección Fiscal Virtual</li>
                                                <li>2 Cajones de Estacionamiento</li>
                                                <li>1 año de renta mínimo</li>
                                            </ul>


                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cotizacionModal">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="floorModal" tabindex="-1" aria-labelledby="floorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="plantabaja-tab" data-bs-toggle="tab"
                                data-bs-target="#plantabaja" type="button" role="tab" aria-controls="plantabaja"
                                aria-selected="true">Planta Baja</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nivel01-tab" data-bs-toggle="tab" data-bs-target="#nivel01"
                                type="button" role="tab" aria-controls="nivel01" aria-selected="false">Nivel 01</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nivel02-tab" data-bs-toggle="tab" data-bs-target="#nivel02"
                                type="button" role="tab" aria-controls="nivel02" aria-selected="false">Nivel 02</button>
                        </li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab content for Planta Baja -->
                        <div class="tab-pane fade show active" id="plantabaja" role="tabpanel"
                            aria-labelledby="plantabaja-tab">
                            <img src="media/local.png" alt="Planta Baja" class="img-fluid" data-bs-toggle="modal"
                                data-bs-target="#nuevoClienteModal">
                        </div>
                        <!-- Tab content for Nivel 01 -->
                        <div class="tab-pane fade" id="nivel01" role="tabpanel" aria-labelledby="nivel01-tab"
                            data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                            <img src="media/local2.png" alt="Nivel 01" class="img-fluid">
                        </div>
                        <!-- Tab content for Nivel 02 -->
                        <div class="tab-pane fade" id="nivel02" role="tabpanel" aria-labelledby="nivel02-tab">
                            <img src="your-image-url.png" alt="Nivel 02" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="cotizacionModal" tabindex="-1" aria-labelledby="cotizacionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cotizacionModalLabel">Cotización: David Sabido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido de la cotización -->
                    <div class="container mt-4">
                        <div class="card p-4">
                            <div class="row">
                                <!-- Columna izquierda: Logo y detalles -->
                                <div class="col-md-3 text-center">
                                    <!-- Logo -->
                                    <img src="path-to-logo.png" alt="Logo" class="img-fluid mb-3">
                                    <p>LOGO</p>
                                </div>

                                <!-- Columna central: Imagen de la plaza -->
                                <div class="col-md-5 text-center">
                                    <img src="media/plaza-arbol.png" alt="Plaza Image" class="img-fluid mb-3">
                                </div>

                                <!-- Columna derecha: Plano -->
                                <div class="col-md-4 text-center">
                                    <img src="media/local.png" alt="Mapa" class="img-fluid mb-3">
                                </div>
                            </div>

                            <!-- Detalles de la cotización -->
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <p><strong>Plaza:</strong> Árbol</p>
                                    <p><strong>Unidad:</strong> Local 02</p>
                                    <p><strong>Precio de Renta:</strong> $7,500.00</p>
                                    <p><strong>Primer Pago:</strong> $22,500.00</p>
                                    <p><strong>Tiempo de Renta:</strong> 1 año</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Horarios:</strong></p>
                                    <p>Lunes: 09:00 am - 08:00 pm</p>
                                    <p>Martes: 09:00 am - 08:00 pm</p>
                                    <p>Miércoles: 09:00 am - 08:00 pm</p>
                                    <p>Jueves: 09:00 am - 08:00 pm</p>
                                    <p>Viernes: 09:00 am - 08:00 pm</p>
                                    <p>Sábado: 09:00 am - 08:00 pm</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Incluye:</strong></p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check2"></i> Baño</li>
                                        <li><i class="bi bi-check2"></i> Recepción</li>
                                        <li><i class="bi bi-check2"></i> Dirección Fiscal Virtual</li>
                                        <li><i class="bi bi-check2"></i> 2 Cajones de Estacionamiento</li>
                                        <li><i class="bi bi-check2"></i> 1 año de renta mínimo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="button" class="btn btn-primary">Enviar por Correo</button>
                    <button type="button" class="btn btn-primary">Descargar PDF</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#clientsTable').DataTable({
                "pageLength": 8,
                "lengthChange": false,
                "order": [[1, "asc"]]
            });
        });
    </script>
</body>

</html>