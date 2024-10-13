<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-dark {
            background-color: #111;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .status-active {
            background-color: #d1f5d3;
            color: #28a745;
        }

        .status-warning {
            background-color: #fff5cc;
            color: #ffc107;
        }

        .status-danger {
            background-color: #f8d7da;
            color: #dc3545;
        }

        .status-info {
            background-color: #dbe5f1;
            color: #6c757d;
        }

        .features-list {
            list-style-type: none;
            padding-left: 0;
        }

        .features-list li {
            display: flex;
            align-items: center;
        }

        .features-list li::before {
            content: '✔';
            color: #28a745;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <x-header />



    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cotizaciones</h2>
            <a type="button" class="btn btn-dark" href="/cotizacion/create">
                + Nueva Cotizacion
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