
$(document).ready(function() {
    $('#clientsTable').DataTable({
        "pageLength": 8,
        "lengthChange": false,
        "order": [
            [1, "asc"]
        ],
        "ajax": {
            "url": "/cotizacionesList",
            "type": "GET",
            "dataSrc": "data" // Ajuste para leer los datos de la respuesta JSON
        },
        "columns": [{
                "data": null,
                "render": function() {
                    return '<input type="checkbox">';
                }
            },
            {
                "data": "cliente"
            },
            {
                "data": "negocio"
            },
            {
                "data": "plaza"
            },
            {
                "data": "local"
            },
            {
                "data": "estatus"
            },
            {
                "data": "opciones",
                "orderable": false
            }
        ]
    });
});