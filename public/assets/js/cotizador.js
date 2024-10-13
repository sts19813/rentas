
let id_proyecto;
let unidadesTable;


$(document).ready(function () {


    $('#prospecto-tab').prop('disabled', true);
    $('#cotizacion-tab').prop('disabled', true);


    //funcion al seleccionar un proyecto
    $('.seleccionar-prospecto').on('click', function () {
        id_proyecto = $(this).data('id');

        $('#prospecto-tab').prop('disabled', false);
        $('#prospecto-tab').tab('show');


        if ($.fn.DataTable.isDataTable('#unitsTable')) {
            unidadesTable.destroy();
        }
        debugger

        unidadesTable = $('#unitsTable').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "lengthMenu": "Mostrar _MENU_ unidades por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ unidades",
                "infoEmpty": "hay unidades disponibles",
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
                url: `/proyectos/${id_proyecto}/unidades`,
                method: 'GET',
                dataSrc: 'data',
            },
            columns: [
                { data: 'nombre', title: 'Nombre' },
                { data: 'metros_cuadrados', title: 'M2' },
                { data: 'precio_por_hora', title: 'Precio x Hora' },
                { data: 'precio_por_mes', title: 'Precio x Mes' },
                { data: 'nivel', title: 'Nivel' },
                { data: 'estatus', title: 'Estatus' },
                {
                    data: null,
                    title: 'Opciones',
                    render: function (data) {
                        let btnClass = '';
                        let disabled = '';
                        
                        switch (data.estatus) {
                            case 'disponible':
                                btnClass = 'btn-success'; // Verde para disponible
                                break;
                            case 'comprometido':
                                btnClass = 'btn-warning'; // Amarillo para comprometido
                                break;
                            case 'rentado':
                                btnClass = 'btn-danger'; // Rojo para rentado
                                disabled = 'disabled'; // Deshabilitado para rentado
                                break;
                        }
            
                        return `<button class="btn ${btnClass} btn-sm seleccionar-unidad" data-id="${data.id}" ${disabled}>Seleccionar</button>`;
                    }
                }
            ]
        });

    });



  

    $('#unitsTable').on('click', '.seleccionar-unidad', function () {
        let unidadId = $(this).data('id');
        alert('Unidad seleccionada con ID: ' + unidadId);
    });
});

