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
                                type="button" role="tab" aria-controls="mapa" aria-selected="false">Documentos</button>
                        </li>

                    </ul>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
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