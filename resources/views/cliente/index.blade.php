<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <x-link></x-link>
</head>

<body>
    <x-header />



    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Clientes</h2>
            <a type="button" class="btn btn-dark" href="/clientes/create">
                + Nuevo Cliente
            </a>
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

                </tbody>
            </table>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            let clientsTable = $('#clientsTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 8,
                lengthChange: false,
                order: [
                    [1, "asc"]
                ],
                language: {
                    "lengthMenu": "Mostrar _MENU_ clientes por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                    "infoEmpty": "No hay clientes disponibles",
                    "infoFiltered": "",
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
                columns: [{
                        data: 'id',
                        title: ''
                    }, // Columna de selección si es necesario
                    {
                        data: 'nombre',
                        title: 'Cliente'
                    },
                    {
                        data: 'negocio.razon_social',
                        title: 'Negocio'
                    },
                    {
                        data: 'plaza.nombre',
                        title: 'Plaza'
                    },
                    {
                        data: 'local',
                        title: 'Local'
                    },
                    {
                        data: 'status',
                        title: 'Estatus'
                    },
                    {
                        data: null,
                        title: 'Opciones',
                        render: function(data) {
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

                            return `<a href="cliente/${data.id}" class="btn ${btnClass} 
                    btn-sm seleccionar-cliente" data-id="${data.id}"
                    data-cliente="${data.cliente}" ${disabled}>ver</a>`;
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>