@extends('layouts.admin')

@section('title', 'Proyecto - ' . $proyecto->nombre)

@section('content')
<div class="content d-flex flex-column flex-column-fluid">
    <!-- HEADER -->
    <div class="d-flex flex-stack mb-5">
        <h1 class="fw-bold text-gray-800 fs-2">
            Proyecto - {{ $proyecto->nombre }} 
            <span class="fs-6 text-gray-500">({{ $textTitle }})</span>
        </h1>
        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-primary">
            <i class="ki-outline ki-pencil fs-5 me-2"></i> Editar
        </a>
    </div>

    <!-- CARD -->
    
        <div class="card-header border-0 pb-0">
            <ul class="nav nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" type="button">General</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#caracteristicas" type="button">Características</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#unidades" type="button">Unidades</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#mapa" type="button">Mapa</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reglas" type="button">Reglas</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#multimedia" type="button">Multimedia</button></li>
            </ul>
        </div>

        <div class="card-body pt-5">
            <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" id="formActualizarProyecto">
                @csrf
                @method('PUT')

                <div class="tab-content" id="myTabContent">
                    <!-- TAB GENERAL -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="mb-5">
                            <h5 class="fw-semibold text-gray-700 mb-4">Información de la Plaza</h5>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <label class="required form-label">Nombre de la plaza</label>
                                    <input type="text" class="form-control form-control-solid" name="nombrePlaza"
                                        value="{{ $proyecto->nombre }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cantidad de Locales</label>
                                    <input type="number" class="form-control form-control-solid" name="cantidadLocales"
                                        value="{{ $proyecto->cantidad_locales }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cajones de Estacionamiento</label>
                                    <input type="number" class="form-control form-control-solid" name="cantidadCajones"
                                        value="{{ $proyecto->cantidad_cajones }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Precio Renta Promedio</label>
                                    <input type="text" class="form-control form-control-solid" name="precioRenta"
                                        value="{{ $proyecto->precio_renta }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cuota de Mantenimiento</label>
                                    <input type="text" class="form-control form-control-solid" name="cuotaMantenimiento"
                                        value="{{ $proyecto->cuota_mantenimiento }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Niveles de la plaza</label>
                                    <input type="number" class="form-control form-control-solid" name="nivelesPlaza"
                                        value="{{ $proyecto->niveles }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Hora Apertura</label>
                                    <input type="time" class="form-control form-control-solid" name="horaApertura"
                                        value="{{ $proyecto->hora_apertura }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Hora Cierre</label>
                                    <input type="time" class="form-control form-control-solid" name="horaCierre"
                                        value="{{ $proyecto->hora_cierre }}" @if($isViewMode) disabled @endif>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h5 class="fw-semibold text-gray-700 mb-4">Ubicación de la Plaza</h5>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <label class="required form-label">Dirección línea 1</label>
                                    <input type="text" class="form-control form-control-solid" name="direccion1"
                                        value="{{ $proyecto->direccion1 }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">País</label>
                                    <input type="text" class="form-control form-control-solid" name="pais"
                                        value="{{ $proyecto->pais }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Estado</label>
                                    <input type="text" class="form-control form-control-solid" name="estado"
                                        value="{{ $proyecto->estado }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Ciudad</label>
                                    <input type="text" class="form-control form-control-solid" name="ciudad"
                                        value="{{ $proyecto->ciudad }}" @if($isViewMode) disabled @endif>
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Código Postal</label>
                                    <input type="text" class="form-control form-control-solid" name="codigoPostal"
                                        value="{{ $proyecto->codigo_postal }}" @if($isViewMode) disabled @endif>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB CARACTERÍSTICAS -->
                    <div class="tab-pane fade" id="caracteristicas">
                        <div class="row g-5 mt-2">
                            <!-- Amenidades -->
                            <div class="col-md-6">
                                <div class="card border shadow-sm">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-semibold">Amenidades</h5>
                                        <button type="button" class="btn btn-light-primary btn-sm">
                                            <i class="ki-outline ki-plus fs-5"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-0 scroll-y" style="max-height:250px;">
                                        <table class="table align-middle table-row-dashed mb-0">
                                            <tbody>
                                                @if($isViewMode)
                                                    @foreach($proyecto->amenidades as $amenidad)
                                                        <tr><td>{{ $amenidad->nombre }}</td></tr>
                                                    @endforeach
                                                @else
                                                    @foreach($amenidades as $amenidad)
                                                    <tr>
                                                        <td>{{ $amenidad->nombre }}</td>
                                                        <td class="text-end">
                                                            <input class="form-check-input" type="checkbox" name="amenidades[]" value="{{ $amenidad->id }}"
                                                                @if($proyecto->amenidades->contains('id', $amenidad->id)) checked @endif>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Servicios -->
                            <div class="col-md-6">
                                <div class="card border shadow-sm">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-semibold">Servicios</h5>
                                        <button type="button" class="btn btn-light-primary btn-sm" id="btn-servicio">
                                            <i class="ki-outline ki-plus fs-5"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-0 scroll-y" style="max-height:250px;">
                                        <table class="table align-middle table-row-dashed mb-0">
                                            <tbody>
                                                @if($isViewMode)
                                                    @foreach($proyecto->servicios as $servicio)
                                                        <tr><td>{{ $servicio->nombre }}</td></tr>
                                                    @endforeach
                                                @else
                                                    @foreach($servicios as $servicio)
                                                    <tr>
                                                        <td>{{ $servicio->nombre }}</td>
                                                        <td class="text-end">
                                                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                                                                @if($proyecto->servicios->contains('id', $servicio->id)) checked @endif>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB UNIDADES -->
                    <div class="tab-pane fade" id="unidades">
                        <div class="d-flex justify-content-between mt-3">
                            <a href="/plantillas/Plantilla Unidades.xlsx" class="btn btn-light-primary">
                                <i class="ki-outline ki-file fs-5 me-2"></i> Descargar Demo
                            </a>
                            <input class="form-control w-25" type="file" id="excelFile" @if($isViewMode) disabled @endif>
                        </div>

                        <div class="table-responsive mt-5">
                            <table id="unidadesTable" class="table align-middle table-row-dashed">
                                <thead class="text-gray-600 fw-semibold">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>M2</th>
                                        <th>Precio x Hora</th>
                                        <th>Precio x Mes</th>
                                        <th>Primer Pago</th>
                                        <th>Nivel</th>
                                        <th>Estatus</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proyecto->unidades as $unidad)
                                    <tr>
                                        <td>{{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->metros_cuadrados }}</td>
                                        <td>${{ number_format($unidad->precio_por_hora, 2) }}</td>
                                        <td>${{ number_format($unidad->precio_por_mes, 2) }}</td>
                                        <td>${{ number_format($unidad->precio_primer_pago, 2) }}</td>
                                        <td>{{ $unidad->nivel }}</td>
                                        <td><span class="badge {{ $unidad->estatus == 'Disponible' ? 'bg-success' : 'bg-danger' }}">{{ $unidad->estatus }}</span></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm removeRow"><i class="ki-outline ki-trash fs-5"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB MAPA -->
                    <div class="tab-pane fade" id="mapa">
                        <div class="card mt-4 border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="fw-semibold text-gray-700 mb-3">Subir Mapa</h5>
                                <input class="form-control form-control-solid" type="file" name="mapas[]" multiple @if($isViewMode) disabled @endif>
                                <div id="preview" class="mt-4 d-flex flex-wrap gap-3 justify-content-center">
                                    @foreach($proyecto->mapas as $mapa)
                                    <img src="{{ asset($mapa->ruta_imagen) }}" alt="{{ $proyecto->nombre }}" class="img-fluid rounded shadow-sm" style="width:220px;">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB REGLAS -->
                    <div class="tab-pane fade" id="reglas">
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Reglamento</label>
                            <div id="reglamento" class="quill-editor border rounded p-3">{!! $proyecto->reglamento !!}</div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Términos y Condiciones</label>
                            <div id="terminos" class="quill-editor border rounded p-3">{!! $proyecto->terminos !!}</div>
                        </div>
                    </div>

                    <!-- TAB MULTIMEDIA -->
                    <div class="tab-pane fade" id="multimedia">
                        <div class="card mt-4 border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="fw-semibold text-gray-700 mb-3">Imágenes de Multimedia</h5>
                                <input class="form-control form-control-solid" type="file" name="multimedias[]" multiple @if($isViewMode) disabled @endif>
                                <div id="preview-multimedias" class="mt-4 d-flex flex-wrap gap-3 justify-content-center">
                                    @foreach($proyecto->multimedias as $multimedia)
                                    <img src="{{ asset($multimedia->ruta_multimedia) }}" alt="{{ $proyecto->nombre }}" class="img-fluid rounded shadow-sm" style="width:220px;">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if(!$isViewMode)
                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-success">
                                <i class="ki-outline ki-check fs-5 me-2"></i> Guardar Proyecto
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    
</div>

<x-script />
<script src="/assets/js/proyecto.js"></script>
@endsection
