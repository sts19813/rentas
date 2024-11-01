<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Agregar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-link></x-link>
</head>

<body>
    <x-header />

    <div class="container mt-5">
        <!-- Main content -->
        <div class="content w-100">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Agregar Cliente</h2>
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
                                aria-controls="caracteristicas" aria-selected="false">Negocio</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="unidades-tab" data-bs-toggle="tab" data-bs-target="#unidades"
                                type="button" role="tab" aria-controls="unidades"
                                aria-selected="false">Referencias</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="mapa-tab" data-bs-toggle="tab" data-bs-target="#mapa"
                                type="button" role="tab" aria-controls="mapa"
                                aria-selected="false">Documentos</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <!-- Contenido del formulario como el de la imagen -->
                            <div class="container">
                                <form>
                                    <h6 class="text-primary">Generales</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="mesRenta" class="form-label">Mes de Renta</label>
                                            <input type="text" class="form-control" id="mesRenta" value="06 / 12">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="plaza" class="form-label">Plaza</label>
                                            <select name="proyecto_id" id="proyecto_id" class="form-control" required>
                                                <option value="">Selecciona un proyecto</option>
                                                @foreach ($proyectos as $proyecto)
                                                <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-4">
                                            <label for="fechaPago" class="form-label">Fecha de Pago</label>
                                            <input type="text" class="form-control" id="fechaPago"
                                                value="15 de cada mes">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="fechaVencimiento" class="form-label">Fecha Vencimiento</label>
                                            <input type="text" class="form-control" id="fechaVencimiento"
                                                value="27 / Oct / 2024">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="local" class="form-label">Local</label>
                                            <select id="unidad" class="form-control" name="unidad_id" required>
                                                <option value="">Selecciona una unidad</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mensualidad" class="form-label">Mensualidad</label>
                                            <input type="text" class="form-control" id="mensualidad"
                                                value="$15,000.00">
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Información Personal</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="nombreCompleto" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre"
                                                value="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nombreCompleto" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="apellido"
                                                value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fechaNacimiento" class="form-label">Fecha de
                                                Nacimiento</label>
                                            <input type="date" class="form-control" id="fechaNacimiento"
                                                value="1988-12-29">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="tipoCliente" class="form-label">Tipo de Cliente</label>
                                            <select id="tipoCliente" class="form-select">
                                                <option selected>Persona física</option>
                                                <option>Persona moral</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correo"
                                                value="lincoln@gmail.com">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                            <select id="nacionalidad" class="form-select">
                                                <option selected>Indonesia</option>
                                                <!-- Otras opciones aquí -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celular"
                                                value="089318298493">
                                        </div>
                                    </div>
                            
                                    <h6 class="text-primary">Dirección Cliente</h6>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">Dirección línea 1</label>
                                        <input type="text" class="form-control" id="direccion"
                                            value="Banyumanik Street, Central Java. Semarang Indonesia">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="pais" class="form-label">País</label>
                                            <input type="text" class="form-control" id="pais"
                                                value="Indonesia">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="estado"
                                                value="Central Java">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ciudadCliente" class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" id="ciudadCliente"
                                                value="Semarang">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="codigoPostal" class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" id="codigoPostal"
                                                value="03125">
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Datos Aval</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombreAval" class="form-label">Nombre Completo</label>
                                            <input type="text" class="form-control" id="nombreAval"
                                                value="Albert Jhonson">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celularAval" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celularAval"
                                                value="080839140011">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="relacionAval" class="form-label">Relación</label>
                                            <input type="text" class="form-control" id="relacionAval"
                                                value="Husband">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="caracteristicas" role="tabpanel"
                            aria-labelledby="caracteristicas-tab">
                            <div class="container mt-4">
                                <form>
                                    <h6 class="text-primary">Información del Negocio</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="razonSocial" class="form-label">Nombre / Razón Social</label>
                                            <input type="text" class="form-control" id="razonSocial"
                                                value="Locker Agencia Creativa SA de CV">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rfc" class="form-label">RFC</label>
                                            <input type="text" class="form-control" id="rfc"
                                                value="29 Diciembre 1988">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="usoFactura" class="form-label">Uso de la Factura</label>
                                            <select id="usoFactura" class="form-select">
                                                <option selected>Seleccionar uso de la factura</option>
                                                <!-- Otras opciones -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regimenFiscal" class="form-label">Régimen fiscal</label>
                                            <select id="regimenFiscal" class="form-select">
                                                <option selected>Seleccionar</option>
                                                <!-- Otras opciones -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="giroNegocio" class="form-label">Giro del Negocio</label>
                                            <select id="giroNegocio" class="form-select">
                                                <option selected>Seleccionar</option>
                                                <!-- Otras opciones -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="correoNegocio" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correoNegocio"
                                                value="lincoln@gmail.com">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cpNegocio" class="form-label">C.P.</label>
                                            <input type="text" class="form-control" id="cpNegocio"
                                                value="Mérida">
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Dirección Facturación</h6>
                                    <div class="mb-3">
                                        <label for="direccionFacturacion" class="form-label">Dirección línea 1</label>
                                        <input type="text" class="form-control" id="direccionFacturacion"
                                            value="Banyumanik Street, Central Java. Semarang Indonesia">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="paisFacturacion" class="form-label">País</label>
                                            <input type="text" class="form-control" id="paisFacturacion"
                                                value="Indonesia">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estadoFacturacion" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="estadoFacturacion"
                                                value="Central Java">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ciudadFacturacion" class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" id="ciudadFacturacion"
                                                value="Semarang">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cpFacturacion" class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" id="cpFacturacion"
                                                value="03125">
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Datos Representante Legal</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombreRepresentante" class="form-label">Nombre
                                                Completo</label>
                                            <input type="text" class="form-control" id="nombreRepresentante"
                                                value="Albert Jhonson">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celularRepresentante" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celularRepresentante"
                                                value="080839140011">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="relacionRepresentante" class="form-label">Relación</label>
                                            <input type="text" class="form-control" id="relacionRepresentante"
                                                value="Husband">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="unidades" role="tabpanel" aria-labelledby="unidades-tab">
                            <div>
                                <!-- Referencia #1 -->
                                <h6 class="text-primary">Referencia #1</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[0][nombre]" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="referencias[0][nombre]"
                                            name="referencias[0][nombre]" placeholder="Escribe el nombre de la persona de referencia 1">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[0][celular]" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="referencias[0][celular]"
                                            name="referencias[0][celular]" value="9992292929292">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[0][correo]" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="referencias[0][correo]"
                                            name="referencias[0][correo]" value="correo@gmail.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[0][relacion]" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="referencias[0][relacion]"
                                            name="referencias[0][relacion]" placeholder="Escribe la relación que tiene con el cliente">
                                    </div>
                                </div>

                                <!-- Referencia #2 -->
                                <h6 class="text-primary">Referencia #2</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[1][nombre]" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="referencias[1][nombre]"
                                            name="referencias[1][nombre]" placeholder="Escribe el nombre de la persona de referencia 2">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[1][celular]" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="referencias[1][celular]"
                                            name="referencias[1][celular]" value="9992292929292">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[1][correo]" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="referencias[1][correo]"
                                            name="referencias[1][correo]" value="correo@gmail.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[1][relacion]" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="referencias[1][relacion]"
                                            name="referencias[1][relacion]" placeholder="Escribe la relación que tiene con el cliente">
                                    </div>
                                </div>

                                <!-- Referencia #3 -->
                                <h6 class="text-primary">Referencia #3</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[2][nombre]" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="referencias[2][nombre]"
                                            name="referencias[2][nombre]" placeholder="Escribe el nombre de la persona de referencia 3">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[2][celular]" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="referencias[2][celular]"
                                            name="referencias[2][celular]" value="9992292929292">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="referencias[2][correo]" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="referencias[2][correo]"
                                            name="referencias[2][correo]" value="correo@gmail.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="referencias[2][relacion]" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="referencias[2][relacion]"
                                            name="referencias[2][relacion]" placeholder="Escribe la relación que tiene con el cliente">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade" id="mapa" role="tabpanel" aria-labelledby="mapa-tab">
                            <div class="container">
                                <!-- Multimedia Section -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Documentos</h5>
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
                                        <h5 class="card-title">Nuevo Documento</h5>
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
                        <div class="col-auto text-right">
                            <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data" id="guardarCliente">
                                @csrf
                                <button type="submit" class="btn btn-warning">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <x-script />
    <script src="/assets/js/cliente.js"></script>
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