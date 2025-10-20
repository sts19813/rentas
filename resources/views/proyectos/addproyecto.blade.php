@extends('layouts.admin')

@section('title', 'Nuevo Proyecto')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-stack mb-5">
            <h1 class="fw-bold text-gray-800 fs-2">Nuevo Proyecto</h1>
            <a href="{{ route('proyectos.index') }}" class="btn btn-light btn-sm">
                <i class="ki-outline ki-arrow-left fs-5"></i> Volver
            </a>
        </div>


        <div class="card-header border-0 pb-0">
            <ul class="nav nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general"
                        type="button">General</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#caracteristicas"
                        type="button">Características</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#unidades" type="button">Unidades</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mapa" type="button">Mapa</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reglas" type="button">Reglas</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#multimedia"
                        type="button">Multimedia</button>
                </li>
            </ul>
        </div>

        <div class="card-body pt-5">
            <form action="{{ route('proyectos.store') }}" method="POST" id="formGuardarProyecto">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <!-- TAB GENERAL -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="mb-5">
                            <h5 class="fw-semibold mb-4 text-gray-700">Información de la Plaza</h5>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <label class="required form-label">Nombre de la plaza</label>
                                    <input type="text" class="form-control form-control-solid" name="nombrePlaza">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cantidad de Locales</label>
                                    <input type="number" class="form-control form-control-solid" name="cantidadLocales">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cajones de Estacionamiento</label>
                                    <input type="number" class="form-control form-control-solid" name="cantidadCajones">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Precio Renta Promedio</label>
                                    <input type="text" class="form-control form-control-solid" name="precioRenta">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Cuota de Mantenimiento</label>
                                    <input type="text" class="form-control form-control-solid" name="cuotaMantenimiento">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Niveles de la Plaza</label>
                                    <input type="number" class="form-control form-control-solid" name="nivelesPlaza">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Hora Apertura</label>
                                    <input type="time" class="form-control form-control-solid" name="horaApertura">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Hora Cierre</label>
                                    <input type="time" class="form-control form-control-solid" name="horaCierre">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h5 class="fw-semibold mb-4 text-gray-700">Ubicación</h5>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <label class="required form-label">Dirección línea 1</label>
                                    <input type="text" class="form-control form-control-solid" name="direccion1">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">País</label>
                                    <input type="text" class="form-control form-control-solid" name="pais">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Estado</label>
                                    <input type="text" class="form-control form-control-solid" name="estado">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Ciudad</label>
                                    <input type="text" class="form-control form-control-solid" name="ciudad">
                                </div>
                                <div class="col-md-6">
                                    <label class="required form-label">Código Postal</label>
                                    <input type="text" class="form-control form-control-solid" name="codigoPostal">
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="button" id="btnSiguiente1" class="btn btn-primary">Siguiente</button>
                        </div>
                    </div>

                    <!-- TAB CARACTERÍSTICAS -->
                    <div class="tab-pane fade" id="caracteristicas">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="card border shadow-sm">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Amenidades</h5>
                                        <button type="button" class="btn btn-light-primary btn-sm">
                                            <i class="ki-outline ki-plus fs-5"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-0 scroll-y" style="max-height:260px;">
                                        <table class="table align-middle table-row-dashed mb-0">
                                            <tbody>
                                                @foreach ($amenidades as $amenidad)
                                                    <tr>
                                                        <td>{{ $amenidad->nombre }}</td>
                                                        <td class="text-end">
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="amenidades[]" value="{{ $amenidad->id }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border shadow-sm">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Servicios</h5>
                                        <button type="button" class="btn btn-light-primary btn-sm" id="btn-servicio">
                                            <i class="ki-outline ki-plus fs-5"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-0 scroll-y" style="max-height:260px;">
                                        <table class="table align-middle table-row-dashed mb-0">
                                            <tbody>
                                                @foreach ($servicios as $servicio)
                                                    <tr>
                                                        <td>{{ $servicio->nombre }}</td>
                                                        <td class="text-end">
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="servicios[]" value="{{ $servicio->id }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="button" id="btnSiguiente2" class="btn btn-primary">Siguiente</button>
                        </div>
                    </div>

                    <!-- TAB UNIDADES -->
                    <div class="tab-pane fade" id="unidades">
                        <div class="d-flex justify-content-between mt-3">
                            <a href="/plantillas/Plantilla Unidades.xlsx" class="btn btn-light-primary">
                                <i class="ki-outline ki-file fs-5 me-2"></i> Descargar plantilla
                            </a>
                            <label for="excelFile" class="btn btn-primary mb-0">
                                <i class="ki-outline ki-upload fs-5 me-2"></i> Importar plantilla
                            </label>
                            <input class="form-control d-none" type="file" id="excelFile">
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
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="text-end mt-5">
                            <button type="button" id="btnSiguiente3" class="btn btn-primary">Siguiente</button>
                        </div>
                    </div>

                    <!-- TAB MAPA -->
                    <div class="tab-pane fade" id="mapa">
                        <div class="card mt-4 border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="fw-semibold text-gray-700 mb-3">Subir Mapa</h5>
                                <input class="form-control form-control-solid" type="file" name="mapas[]" multiple>
                                <div id="preview" class="mt-4 d-flex flex-wrap gap-3 justify-content-center"></div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="button" id="btnSiguiente4" class="btn btn-primary">Siguiente</button>
                        </div>
                    </div>

                    <!-- TAB REGLAS -->
                    <div class="tab-pane fade" id="reglas">
                        <div class="mb-5">
                            <label class="form-label">Reglamento</label>
                            <div id="reglamento" class="quill-editor border rounded"></div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Términos y Condiciones</label>
                            <div id="terminos" class="quill-editor border rounded"></div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="button" id="btnSiguiente5" class="btn btn-primary">Siguiente</button>
                        </div>
                    </div>

                    <!-- TAB MULTIMEDIA -->
                    <div class="tab-pane fade" id="multimedia">
                        <div class="card mt-4 border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="fw-semibold text-gray-700 mb-3">Sube las imágenes de multimedia</h5>
                                <input class="form-control form-control-solid" type="file" name="multimedias[]" multiple>
                                <div id="preview-multimedias" class="mt-4 d-flex flex-wrap gap-3 justify-content-center">
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-success">
                                <i class="ki-outline ki-check fs-5 me-2"></i> Guardar Proyecto
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <x-script />
    <script src="/assets/js/proyecto.js"></script>
@endsection