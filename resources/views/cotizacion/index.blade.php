@extends('layouts.admin')

@section('content')
    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold mb-0">Cotizaciones</h2>

        <a href="{{ url('/cotizacion/create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="ki-duotone ki-plus fs-2 me-1"></i>
            Nueva Cotización
        </a>
        </div>

        <br>

        <!-- Tabla -->

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="clientsTable"
                    class="table align-middle table-row-dashed table-row-gray-300 gy-4 gs-0 text-center">
                    <thead class="bg-light">
                        <tr class="fw-semibold text-muted text-uppercase">
                            <th class="w-25px"></th>
                            <th>Cliente</th>
                            <th>Negocio</th>
                            <th>Plaza</th>
                            <th>Local</th>
                            <th>Estatus</th>
                            <th class="text-end">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Aquí se llenará dinámicamente --}}
                    </tbody>
                </table>
            </div>

        </div>
@endsection

    @push('scripts')
        <script src="/assets/js/cotizador-index.js"></script>
    @endpush