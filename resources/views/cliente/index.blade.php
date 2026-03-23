@extends('layouts.admin')

@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 my-0">Clientes</h1>

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="/clientes/create" class="btn btn-dark">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Nuevo Cliente
                </a>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->



    <!--begin::Card-->
    <div class="card card-flush shadow-sm">

        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5 border-0">
            <div class="card-title">
                <h3 class="fw-bold mb-0">Listado de Clientes</h3>
            </div>
            <div class="card-toolbar">
                <button class="btn btn-light-secondary">
                    <i class="ki-duotone ki-download fs-3"></i>
                    Descargar
                </button>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table id="clientsTable" class="table table-row-dashed table-row-gray-300 align-middle gy-4">
                    <thead class="fw-semibold fs-7 text-uppercase bg-light text-gray-500">
                        <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Negocio</th>
                            <th>Plaza</th>
                            <th>Local</th>
                            <th>Estatus</th>
                            <th class="text-end">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600"></tbody>
                </table>
            </div>
        </div>
        <!--end::Card body-->

    </div>
    <!--end::Card-->



@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#clientsTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 8,
                lengthChange: false,
                order: [[1, "asc"]],
                language: {
                    "lengthMenu": "Mostrar _MENU_ clientes por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                    "infoEmpty": "No hay clientes disponibles",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                ajax: {
                    url: '/clientestable/',
                    method: 'GET',
                    dataSrc: 'data',
                },
                columns: [
                    { data: 'id', title: '' },
                    { data: 'nombre', title: 'Cliente' },
                    { data: 'negocio.razon_social', title: 'Negocio' },
                    { data: 'plaza.nombre', title: 'Plaza' },
                    { data: 'local', title: 'Local' },
                    { data: 'status', title: 'Estatus' },
                    {
                        data: null,
                        title: 'Opciones',
                        className: "text-end",
                        render: function (data) {
                            let btnClass = '';
                            let disabled = '';

                            switch (data.estatus) {
                                case 'activo':
                                    btnClass = 'btn-success';
                                    break;
                                case 'inactivo':
                                    btnClass = 'btn-danger';
                                    disabled = 'disabled';
                                    break;
                                default:
                                    btnClass = 'btn-secondary';
                            }

                            return `
                                <a href="/cliente/${data.id}" 
                                   class="btn ${btnClass} btn-sm seleccionar-cliente"
                                   data-id="${data.id}" ${disabled}>
                                   Ver
                                </a>`;
                        }
                    }
                ]
            });
        });
    </script>
@endpush