@extends('layouts.admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h2 class="fw-bold mb-0">Nueva Cotización</h2>
        </div>
    </div>

    <!-- Contenido principal -->
    
        <div class="card-body py-5">

            <!-- Tabs estilo Metronic -->
            <ul class="nav nav-line-tabs nav-line-tabs-2x mb-5 fs-6 fw-bold" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                        type="button" role="tab">Proyecto</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="unidad-tab" data-bs-toggle="tab" data-bs-target="#unidad" type="button"
                        role="tab">Unidad</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="prospecto-tab" data-bs-toggle="tab" data-bs-target="#prospecto"
                        type="button" role="tab">Prospecto</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cotizacion-tab" data-bs-toggle="tab" data-bs-target="#cotizacion"
                        type="button" role="tab">Cotización</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reporte-tab" data-bs-toggle="tab" data-bs-target="#reporte" type="button"
                        role="tab">Reporte</button>
                </li>
            </ul>

            <!-- Tabs contenido -->
            <div class="tab-content" id="myTabContent">

                <!-- =============== TAB: PROYECTO ================= -->
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <h3 class="mb-4">Seleccione el proyecto a cotizar</h3>

                    <div class="row g-5">
                        @foreach ($proyectos as $proyecto)
                            <div class="col-md-4">
                                <div class="card h-100 border-hover-primary">
                                    <div class="card-body p-0">
                                        @if ($proyecto->mapas->isNotEmpty())
                                            <img src="{{ asset($proyecto->mapas->first()->ruta_imagen) }}"
                                                alt="{{ $proyecto->nombre }}" class="img-fluid rounded-top">
                                        @else
                                            <img src="https://via.placeholder.com/400x200" class="img-fluid rounded-top"
                                                alt="Imagen por defecto">
                                        @endif
                                    </div>
                                    <div class="card-footer pt-4">
                                        <h5 class="fw-bold">{{ $proyecto->nombre }}</h5>
                                        <div class="text-muted small mb-2">{{ $proyecto->unidades->count() }} Unidades</div>

                                        <span
                                            class="badge {{ $proyecto->unidades->where('estatus', 'Rentado')->count() == $proyecto->unidades->count() ? 'badge-light-danger' : 'badge-light-success' }}">
                                            {{ $proyecto->unidades->where('estatus', 'Rentado')->count() == $proyecto->unidades->count() ? '100% Ocupado' : 'Disponible' }}
                                        </span>

                                        <div class="mt-3 text-end">
                                            <button class="btn btn-light-primary seleccionar-unidad"
                                                data-id="{{ $proyecto->id }}">
                                                <i class="ki-duotone ki-check fs-3 me-1"></i> Seleccionar y Cotizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- =============== TAB: UNIDAD ================= -->
                <div class="tab-pane fade" id="unidad" role="tabpanel">
                    <h4 class="mb-4">Seleccione una unidad</h4>
                    <div class="table-responsive">
                        <table id="unitsTable"
                            class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 text-center">
                            <thead class="bg-light">
                                <tr class="fw-bold text-muted text-uppercase">
                                    <th>Nombre</th>
                                    <th>M²</th>
                                    <th>Precio por Hora</th>
                                    <th>Precio por Mes</th>
                                    <th>Primer Pago</th>
                                    <th>Nivel</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- =============== TAB: PROSPECTO ================= -->
                <div class="tab-pane fade" id="prospecto" role="tabpanel">
                    <h4 class="mb-4">Información Personal</h4>

                    <form>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control form-control-solid" id="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido *</label>
                                <input type="text" class="form-control form-control-solid" id="apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tipoCliente" class="form-label">Tipo de Cliente *</label>
                                <select class="form-select form-select-solid" id="tipoCliente" required>
                                    <option selected disabled>Seleccione...</option>
                                    <option value="persona_fisica">Persona física</option>
                                    <option value="persona_moral">Persona moral</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo *</label>
                                <input type="email" class="form-control form-control-solid" id="correo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="celular" class="form-label">Celular *</label>
                                <input type="tel" class="form-control form-control-solid" id="celular" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary" id="nextTabButton">
                                Siguiente
                            </button>
                        </div>
                    </form>
                </div>

                <!-- =============== TAB: COTIZACIÓN ================= -->
                <div class="tab-pane fade" id="cotizacion" role="tabpanel">
                    <h4 class="mb-4">Detalle de Cotización</h4>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Precio de Renta *</label>
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-muted">Mes:</span>
                                <input type="text" id="inputmesRenta" class="form-control form-control-solid w-100"
                                    disabled>
                                <span class="text-muted">Hr:</span>
                                <input type="text" id="inputRentaHr" class="form-control form-control-solid w-100" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="primerPago" class="form-label">Primer Pago *</label>
                            <input type="text" class="form-control form-control-solid" id="primerPago" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tiempo *</label>
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-muted">Periodo:</span>
                                <input type="text" id="inputTiempoCotizacion" class="form-control form-control-solid w-50">
                                <select class="form-select form-select-solid w-50" id="tiempo">
                                    <option>años</option>
                                    <option>meses</option>
                                    <option>horas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="fechaInicio" class="form-label">Fecha Inicio *</label>
                            <input type="datetime-local" class="form-control form-control-solid" id="fechaInicio">
                        </div>
                    </div>

                    <div class="fs-6 mb-5">
                        Cotización aproximada del periodo:
                        <strong class="text-primary">$<span id="Txtcotizacion">100</span></strong>
                    </div>

                    <div id="contenedorServicios" class="mb-5"></div>

                    <div class="text-end">
                        <button id="nextTabButtonReporte" class="btn btn-primary">
                            Siguiente
                        </button>
                    </div>
                </div>

                <!-- =============== TAB: REPORTE ================= -->
                <div class="tab-pane fade" id="reporte" role="tabpanel">
                    <div class="p-5">
                        <h3 class="mb-4">Resumen de Cotización</h3>

                        <div class="row mb-4">
                            <div class="col-md-2 text-center">
                                <img src="/media/logos/logo.svg" alt="Logo" class="img-fluid mb-3">
                                <p class="fw-semibold">LOGO</p>
                            </div>
                            <div class="col-md-5">
                                <img src="#" id="mapaCotizacion" alt="Imagen Plaza" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-5">
                                <img src="#" id="mapaMultimedia" alt="Mapa Plaza" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-4">
                                <p><strong>Plaza:</strong> <span id="namePlaza"></span></p>
                                <p><strong>Unidad:</strong> <span id="nombreUnidad"></span></p>
                                <p><strong>Precio Renta Mes:</strong> $<span id="PrecioRentaMes"></span></p>
                                <p><strong>Precio Renta Hr:</strong> $<span id="PrecioRentaHr"></span></p>
                                <p><strong>Primer Pago:</strong> $<span id="primerPagoC"></span></p>
                                <p><strong>Tiempo:</strong> <span id="tiempoRentaC"></span></p>
                                <p><strong>Total:</strong> $<span id="totalRentaC"></span></p>
                            </div>
                            <div class="col-md-8">
                                <p><strong>Fechas:</strong></p>
                                <ul class="list-unstyled mb-4">
                                    <li>Inicio: <span id="fechaInicioC"></span></li>
                                    <li>Fin: <span id="fechaFinC"></span></li>
                                </ul>
                                <p><strong>Horarios:</strong></p>
                                <ul class="list-unstyled">
                                    <li>Apertura: <span id="horaApertura"></span></li>
                                    <li>Cierre: <span id="horaCierre"></span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5>Incluye:</h5>
                            <ul class="list-unstyled" id="contenedorServicios2"></ul>
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn btn-light-primary">Enviar correo</button>
                            <button type="button" class="btn btn-success" id="generarPDF">Descargar PDF</button>
                            <form action="{{ route('cotizacion.store') }}" method="POST" id="guardarCotizacion">
                                @csrf
                                <button type="submit" class="btn btn-warning">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    


@endsection

@push('scripts')
    <script src="/assets/js/cotizador.js"></script>
@endpush