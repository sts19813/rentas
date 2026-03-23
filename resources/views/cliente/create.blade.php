@extends('layouts.admin')

@section('content')

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-7">
        <h2 class="fw-bold mb-0">Agregar Cliente</h2>
    </div>


    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#estadoCuenta">Estado de cuenta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#general">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#caracteristicas">Negocio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#unidades">Referencias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#mapa">Documentos</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- ============================
                                    TAB 1: Estado de Cuenta
                                ============================ -->
        <div class="tab-pane fade show active" id="estadoCuenta" role="tabpanel">
            <div class="mb-5">
                <h5 class="text-primary mb-4">Generales</h5>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Plaza</label>
                        <select name="proyecto_id" id="proyecto_id" class="form-select">
                            <option value="">Selecciona un proyecto</option>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha de Pago</label>
                        <select id="fechaPago" class="form-select">
                            <option value="">Selecciona una fecha</option>
                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}">{{ $i }} de cada mes</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Días Tolerancia</label>
                        <input type="number" id="tolerancia" value="0" class="form-control">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Local</label>
                        <select id="unidad" class="form-select">
                            <option value="">Selecciona una unidad</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mensualidad</label>
                        <input type="text" id="mensualidad" class="form-control">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0">Precios de Renta por Rango de Fechas</h5>
                <button class="btn btn-light-primary btn-sm" id="add-row-btn">
                    <i class="ki-duotone ki-plus fs-3"></i> Agregar
                </button>
            </div>

            <div class="table-responsive mb-5">
                <table class="table table-row-dashed align-middle" id="rangos-table">
                    <thead class="text-muted fw-semibold text-uppercase bg-light">
                        <tr>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0">Tabla de Amortización</h5>
                <a id="amortizacion" class="btn btn-outline btn-outline-primary btn-sm">Generar</a>
            </div>

            <div class="table-responsive">
                <table id="amortizacion-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Monto</th>
                            <th>Fecha de pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- ============================
                                    TAB 2: General
                                ============================ -->
        <div class="tab-pane fade" id="general" role="tabpanel">
            <h5 class="text-primary mb-4">Información Personal</h5>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" id="nombre" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" id="apellido" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" class="form-control">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Tipo de Cliente</label>
                    <select id="tipoCliente" class="form-select">
                        <option value="persona_fisica" selected>Persona física</option>
                        <option value="persona_moral">Persona moral</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Correo</label>
                    <input type="email" id="correo" class="form-control">
                </div>
            </div>

            <h5 class="text-primary mb-4">Dirección</h5>

            <div class="row mb-4">
                <div class="col-md-3"><label class="form-label">País</label><input type="text" id="pais"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Estado</label><input type="text" id="estado"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Ciudad</label><input type="text" id="ciudadCliente"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Código Postal</label><input type="text" id="codigoPostal"
                        class="form-control"></div>
            </div>

            <h5 class="text-primary mb-4">Datos Aval</h5>
            <div class="row mb-4">
                <div class="col-md-6"><label class="form-label">Nombre</label><input type="text" id="nombreAval"
                        class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Celular</label><input type="tel" id="celularAval"
                        class="form-control"></div>
            </div>
        </div>

        <!-- ============================
                                    TAB 3: Negocio
                                ============================ -->
        <div class="tab-pane fade" id="caracteristicas" role="tabpanel">
            <h5 class="text-primary mb-4">Información del Negocio</h5>

            <div class="row mb-4">
                <div class="col-md-6"><label class="form-label">Razón Social</label><input type="text" id="razonSocial"
                        class="form-control"></div>
                <div class="col-md-6"><label class="form-label">RFC</label><input type="text" id="rfc" class="form-control">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6"><label class="form-label">Uso de la Factura</label><select id="usoFactura"
                        class="form-select">
                        <option>Seleccionar</option>
                    </select></div>
                <div class="col-md-6"><label class="form-label">Régimen Fiscal</label><select id="regimenFiscal"
                        class="form-select">
                        <option>Seleccionar</option>
                    </select></div>
            </div>

            <h5 class="text-primary mb-4">Dirección Facturación</h5>
            <div class="row mb-4">
                <div class="col-md-3"><label class="form-label">País</label><input type="text" id="paisFacturacion"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Estado</label><input type="text" id="estadoFacturacion"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Ciudad</label><input type="text" id="ciudadFacturacion"
                        class="form-control"></div>
                <div class="col-md-3"><label class="form-label">Código Postal</label><input type="text" id="cpFacturacion"
                        class="form-control"></div>
            </div>
        </div>

        <!-- ============================
                                    TAB 4: Referencias
                                ============================ -->
        <div class="tab-pane fade" id="unidades" role="tabpanel">
            <h5 class="text-primary mb-4">Referencias</h5>
            @for ($i = 1; $i <= 3; $i++)
                <div class="card mb-5 border-dashed">
                    <div class="card-body">
                        <h6 class="fw-bold text-gray-700 mb-4">Referencia #{{ $i }}</h6>
                        <div class="row mb-3">
                            <div class="col-md-6"><label class="form-label">Nombre</label><input type="text"
                                    class="form-control" id="nombreR{{ $i }}"></div>
                            <div class="col-md-6"><label class="form-label">Celular</label><input type="text"
                                    class="form-control" id="celularR{{ $i }}"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label class="form-label">Correo</label><input type="email"
                                    class="form-control" id="correoR{{ $i }}"></div>
                            <div class="col-md-6"><label class="form-label">Relación</label><input type="text"
                                    class="form-control" id="relacionR{{ $i }}"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <!-- ============================
                                    TAB 5: Documentos
                                ============================ -->
        <div class="tab-pane fade" id="mapa" role="tabpanel">
            <h5 class="text-primary mb-4">Documentos</h5>
            <div class="card">
                <div class="card-body text-center">
                    <input class="form-control mb-4" type="file" id="documentos" name="documentos[]" multiple>
                    <div id="preview-documentos" class="d-flex flex-wrap gap-3 justify-content-center"></div>
                </div>
            </div>

            <div class="mt-6 text-end">
                <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data" id="guardarCliente">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-3"></i> Guardar Cliente
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/locale/es.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/isSameOrBefore.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/isSameOrAfter.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/customParseFormat.js"></script>
    <script src="/assets/js/cliente.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    dayjs.locale('es');
    dayjs.extend(dayjs_plugin_customParseFormat);
    dayjs.extend(dayjs_plugin_isSameOrBefore);
    dayjs.extend(dayjs_plugin_isSameOrAfter);
    </script>
@endpush