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
                <h2>Cliente ({{ $textTitle }})</h2>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="estadoCuenta-tab" data-bs-toggle="tab"
                                data-bs-target="#estadoCuenta" type="button" role="tab" aria-controls="estadoCuenta"
                                aria-selected="true">Estado de cuenta</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="general-tab" data-bs-toggle="tab"
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
                        <div class="tab-pane fade show active" id="estadoCuenta" role="tabpanel"
                            aria-labelledby="estadoCuenta-tab">
                            <div class="container">

                                <br>
                                <h6 class="text-primary">Generales</h6>
                                <div class="row mb-3">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="mesRenta" class="form-label">fecha de inicio</label>
                                            <input type="date" class="form-control" id="mesRenta" value="{{ $cliente->fecha_inicio }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="plaza" class="form-label">Plaza</label>
                                            <select name="proyecto_id" id="proyecto_id" class="form-control" required @if ($isViewMode) disabled @endif>
                                                <option value="">Selecciona un proyecto</option>
                                                @foreach ($proyectos as $proyecto)
                                                <option value="{{ $proyecto->id }}" @selected(isset($cliente->plaza) && $cliente->plaza == $proyecto->id)>
                                                    {{ $proyecto->nombre }}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-2">
                                            <label for="fechaPago" class="form-label">Fecha de Pago</label>
                                            <input type="text" class="form-control" id="fechaPago"
                                                value="{{ $cliente->fecha_pago }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="fechaPago" class="form-label">Tolerancia</label>
                                            <input type="text" class="form-control" id="tolerancia"
                                                value="{{ $cliente->tolerancia }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="fechaVencimiento" class="form-label">Fecha Vencimiento</label>
                                            <input type="date" class="form-control" id="fechaVencimiento"
                                                value="{{ $cliente->fecha_vencimiento }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="local" class="form-label">Local</label>
                                            <select id="unidad" class="form-control" name="unidad" @if ($isViewMode) disabled @endif>
                                                <option value="">Selecciona una unidad</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mensualidad" class="form-label">Mensualidad</label>
                                            <input type="text" class="form-control" id="mensualidad"
                                                value="{{ $cliente->mensualidad }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>




                                </div>

                            </div>
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary mb-0">Configurar Precios de Renta por Rango de Fechas</h6>
                                <button class="btn btn-primary" id="add-row-btn">
                                    <i class="fas fa-plus"></i> +
                                </button>
                            </div>

                            <table class="table table-bordered mt-3" id="rangos-table">
                                <thead>
                                    <tr>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cliente->rentPrice as $rango)
                                    <tr>
                                        <td>{{ $rango->start_date }}</td>
                                        <td>{{ $rango->end_date }}</td>
                                        <td>{{ $rango->price }}</td>
                                        <td>
                                            @if(!$isViewMode)
                                            <button class="btn btn-danger btn-sm delete-row" data-id="{{ $rango->id }}">Eliminar</button>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <br><br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary mb-0">Tabla de amortizacion</h6>

                                <a id="amortizacion" class="" id="add-row-btn">
                                    Generar
                                </a>
                            </div>

                            <table class="table table-bordered mt-3" id="amortizacion-table">
                                <thead>
                                    <tr>
                                        <th>Periodo</th>
                                        <th>mensualidad</th>
                                        <th>fecha pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>


                            <br> <br>
                        </div>
                        <div class="tab-pane fade show" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="container">
                                <form>
                                    <h6 class="text-primary">Generales</h6>


                                    <h6 class="text-primary">Información Personal</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="nombreCompleto" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre"
                                                value="{{ $cliente->nombre }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nombreCompleto" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="apellido"
                                                value="{{ $cliente->apellido }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fechaNacimiento" class="form-label">Fecha de
                                                Nacimiento</label>
                                            <input type="date" class="form-control" id="fechaNacimiento"
                                                value="{{ $cliente->fecha_nacimiento }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="tipoCliente" class="form-label">Tipo de Cliente</label>
                                            <select id="tipoCliente" class="form-select" @if ($isViewMode) disabled @endif>
                                                <option value="persona_fisica" selected>Persona física</option>
                                                <option value="persona_moral">Persona moral</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correo"
                                                value="{{ $cliente->correo }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                            <select id="nacionalidad" class="form-select" @if ($isViewMode) disabled @endif>
                                                <option selected>Indonesia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celular"
                                                value="{{ $cliente->celular }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Dirección Cliente</h6>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">Dirección línea 1</label>
                                        <input type="text" class="form-control" id="direccion"
                                            value="{{ $cliente->direccion }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="pais" class="form-label">País</label>
                                            <input type="text" class="form-control" id="pais"
                                                value="{{ $cliente->pais }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="estado"
                                                value="{{ $cliente->estado }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ciudadCliente" class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" id="ciudadCliente"
                                                value="{{ $cliente->ciudad_cliente }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="codigoPostal" class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" id="codigoPostal"
                                                value="{{ $cliente->codigo_postal }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Datos Aval</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombreAval" class="form-label">Nombre Completo</label>
                                            <input type="text" class="form-control" id="nombreAval"
                                                value="{{ $cliente->nombre_aval }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celularAval" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celularAval"
                                                value="{{ $cliente->celular_aval }}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="relacionAval" class="form-label">Relación</label>
                                            <input type="text" class="form-control" id="relacionAval"
                                                value="{{ $cliente->relacion_aval }}"
                                                @if ($isViewMode) disabled @endif>
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
                                                value="{{ $cliente->negocio->razon_social}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rfc" class="form-label">RFC</label>
                                            <input type="text" class="form-control" id="rfc"
                                                value="{{ $cliente->negocio->rfc}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="usoFactura" class="form-label">Uso de la Factura</label>
                                            <select id="usoFactura" class="form-select" @if ($isViewMode) disabled @endif>
                                                <option selected>Seleccionar uso de la factura</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regimenFiscal" class="form-label">Régimen fiscal</label>
                                            <select id="regimenFiscal" class="form-select" @if ($isViewMode) disabled @endif>
                                                <option selected>Seleccionar</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="giroNegocio" class="form-label">Giro del Negocio</label>
                                            <select id="giroNegocio" class="form-select" @if ($isViewMode) disabled @endif>
                                                <option selected>Seleccionar</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="correoNegocio" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correoNegocio"
                                                value="{{ $cliente->negocio->correo}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cpNegocio" class="form-label">C.P.</label>
                                            <input type="text" class="form-control" id="cpNegocio"
                                                value="{{ $cliente->negocio->cp}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Dirección Facturación</h6>
                                    <div class="mb-3">
                                        <label for="direccionFacturacion" class="form-label">Dirección línea 1</label>
                                        <input type="text" class="form-control" id="direccionFacturacion"
                                            value="{{ $cliente->negocio->direccion_facturacion}}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="paisFacturacion" class="form-label">País</label>
                                            <input type="text" class="form-control" id="paisFacturacion"
                                                value="{{ $cliente->negocio->pais_facturacion}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estadoFacturacion" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="estadoFacturacion"
                                                value="{{ $cliente->negocio->estado_facturacion}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ciudadFacturacion" class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" id="ciudadFacturacion"
                                                value="{{ $cliente->negocio->ciudad_facturacion}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cpFacturacion" class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" id="cpFacturacion"
                                                value="{{ $cliente->negocio->cp_facturacion}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>

                                    <h6 class="text-primary">Datos Representante Legal</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombreRepresentante" class="form-label">Nombre
                                                Completo</label>
                                            <input type="text" class="form-control" id="nombreRepresentante"
                                                value="{{ $cliente->negocio->nombre_representante}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="celularRepresentante" class="form-label">Celular</label>
                                            <input type="tel" class="form-control" id="celularRepresentante"
                                                value="{{ $cliente->negocio->celular_representante}}"
                                                @if ($isViewMode) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="relacionRepresentante" class="form-label">Relación</label>
                                            <input type="text" class="form-control" id="relacionRepresentante"
                                                value="{{ $cliente->negocio->relacion_representante}}"
                                                @if ($isViewMode) disabled @endif>
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
                                        <label for="nombreR1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreR1"
                                            name="nombreR1" placeholder="Escribe el nombre de la persona de referencia 1"
                                            value="{{ $cliente->nombreR1 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="celularR1" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celularR1"
                                            name="celularR1"
                                            value="{{ $cliente->celularR1 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="correoR1" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correoR1"
                                            name="correoR1"
                                            value="{{ $cliente->correoR1 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="relacionR1" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="relacionR1"
                                            name="relacionR1"
                                            value="{{ $cliente->relacionR1}}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                </div>

                                <!-- Referencia #2 -->
                                <h6 class="text-primary">Referencia #2</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nombreR2" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreR2"
                                            name="nombreR2"
                                            value="{{ $cliente->nombreR2 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="celularR2" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celularR2"
                                            name="celularR2"
                                            value="{{ $cliente->celularR2 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="correoR2" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correoR2"
                                            name="correoR2" value="{{ $cliente->correoR2 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="relacionR2" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="relacionR2"
                                            name="relacionR2"
                                            value="{{ $cliente->relacionR2 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                </div>

                                <!-- Referencia #3 -->
                                <h6 class="text-primary">Referencia #3</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nombreR3" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreR3"
                                            name="nombreR3"
                                            value="{{ $cliente->nombreR3 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="celularR3" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celularR3"
                                            name="celularR3" value="{{ $cliente->celularR3 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="correoR3" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correoR3"
                                            name="correoR3" value="{{ $cliente->correoR3 }}"
                                            @if ($isViewMode) disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="relacionR3" class="form-label">Relación</label>
                                        <input type="text" class="form-control" id="relacionR3"
                                            name="relacionR3"
                                            value="{{ $cliente->relacionR3 }}"
                                            @if ($isViewMode) disabled @endif>
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
                                        <div class="row">
                                            @foreach ($cliente->documentos as $documento)
                                            <div class="col-md-4">
                                                <a href="{{ asset($documento->ruta) }}" download="{{ basename($documento->ruta) }}" class="btn btn-link">
                                                    {{$documento->ruta ?? 'Documento' }}
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-right">
                                    <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data" id="guardarCliente">
                                        @csrf

                                        @if (!$isViewMode)
                                        <button type="submit" class="btn btn-warning">Guardar</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>

    <div id="data-container" data-local-id="{{ $cliente->local ?? 'null' }}"></div>


    <x-script />

    <script>
        let localId = document.getElementById('data-container').dataset.localId;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/locale/es.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/isSameOrBefore.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/isSameOrAfter.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/customParseFormat.js"></script>
    <script src="/assets/js/cliente.js"></script>


</body>

</html>