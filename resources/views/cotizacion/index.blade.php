<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizacion</title>

    <x-link></x-link>

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
                   
                </tbody>
            </table>
        </div>
    </div>


    <x-script />
    <script src="/assets/js/cotizador-index.js"></script>

</body>

</html>
