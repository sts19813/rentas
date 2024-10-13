
let id_proyecto; //id del proyecto que se selecciona en la cotizacion
let unidadesTable; //este es del objeto data table
let unidadId;   //unidad que se selecciona en la cotizacion
let servicios_Proyecto;
let amenidades_Proyecto;
let total;//total aprox de toda la cotizacion


//cotizacion
let mesRenta, horaRenta, primerPago, nombreUnidad, tipoRenta, duracion, fechaInicio;

//prospecto
let nombre, apellido, tipoCliente, correo, celular;


$(document).ready(function () {
    $('#unidad-tab').prop('disabled', true);
    $('#cotizacion-tab').prop('disabled', true);
    $('#prospecto-tab').prop('disabled', true);
    $('#reporte-tab').prop('disabled', true);


    //funcion al seleccionar un proyecto
    $('.seleccionar-unidad').on('click', function () {
        id_proyecto = $(this).data('id');

        $('#unidad-tab').prop('disabled', false);
        $('#unidad-tab').tab('show');


        if ($.fn.DataTable.isDataTable('#unitsTable')) {
            unidadesTable.destroy();
        }

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
                { data: 'precio_primer_pago', title: 'Primer pago' },
                { data: 'nivel', title: 'Nivel' },
                { data: 'estatus', title: 'Estatus' },
                {
                    data: null,
                    title: 'Opciones',
                    render: function (data) {

                        servicios_Proyecto = data.servicios;
                        amenidades_Proyecto = data.amenidades;
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

                        return `<button class="btn ${btnClass} 
                        btn-sm seleccionar-unidad" data-id="${data.id}"
                        data-nombre="${data.nombre}" 
                        data-metros="${data.metros_cuadrados}"
                        data-mesRenta="${data.precio_por_mes}"
                        data-horaRenta="${data.precio_por_hora}"
                        data-primerPago="${data.precio_primer_pago}"
                            ${disabled}>Seleccionar</button>`;
                    }
                }
            ]
        });

    });

    //seleccion de una unidad
    $('#unitsTable').on('click', '.seleccionar-unidad', function () {
        
        $('#prospecto-tab').prop('disabled', false);
        $('#prospecto-tab').tab('show');

        mesRenta = $(this).data().mesrenta;
        horaRenta = $(this).data().horarenta;
        primerPago = $(this).data().primerpago;
        nombreUnidad = $(this).data().nombre;

        unidadId = $(this).data('id');
    });


    //boton de siguiente, pasa a la cotizacion
    $('#nextTabButton').on('click', function () {

        nombre = $('#nombre').val();
        apellido = $('#apellido').val();
        tipoCliente = $('#tipoCliente').val();
        correo = $('#correo').val();
        celular = $('#celular').val();

        //validar form antes de eso
        $('#cotizacion-tab').prop('disabled', false);
        $('#cotizacion-tab').tab('show');

        $('#inputmesRenta').val(mesRenta);
        $('#inputRentaHr').val(horaRenta);
        $('#primerPago').val(primerPago);

        let servicios = servicios_Proyecto + ',' + amenidades_Proyecto;
        // Separar los servicios por comas
        let serviciosArray = servicios.split(',');

        // Crear la lista de servicios en HTML
        let listaServiciosHtml = '<ul class="list-unstyled">';
        serviciosArray.forEach(function (servicio) {
            listaServiciosHtml += `<li><i class="bi bi-check-circle-fill text-success"></i> ${servicio.trim()}</li>`;
        });
        listaServiciosHtml += '</ul>';

        // Agregar la lista al contenedor deseado en tu HTML
        document.getElementById('contenedorServicios').innerHTML = listaServiciosHtml;
    });

    //boton de siguiente, pasa al reporte
    $('#nextTabButtonReporte').on('click', function () {
        //validar form antes de eso
        $('#reporte-tab').prop('disabled', false);
        $('#reporte-tab').tab('show');


        $('#nombreCotizacion').text(nombre + ' ' + apellido);//nombre de la cotizacion

        $.ajax({
            url: '/proyectos/find/' + id_proyecto,
            type: 'GET',
            success: function (response) {

                if (response.mapas && response.mapas.length > 0 && response.mapas[0].ruta_imagen)
                    $('#mapaCotizacion').attr('src', '/' + response.mapas[0].ruta_imagen);


                // Validar si response.multimedias existe y tiene al menos un elemento con una ruta válida
                if (response.multimedias && response.multimedias.length > 0 && response.multimedias[0].ruta_multimedia)
                    $('#mapaMultimedia').attr('src', '/' + response.multimedias[0].ruta_multimedia);

                $('#nombreUnidad').text(nombreUnidad);
                $('#namePlaza').text(response.nombre);
                $('#PrecioRentaMes').text(mesRenta);
                $('#PrecioRentaHr').text(horaRenta);
                $('#primerPagoC').text(primerPago);

                $('#horaApertura').text(response.hora_apertura);
                $('#horaCierre').text(response.hora_cierre);

                let servicios = servicios_Proyecto + ',' + amenidades_Proyecto;
                // Separar los servicios por comas
                let serviciosArray = servicios.split(',');

                // Crear la lista de servicios en HTML
                let listaServiciosHtml = '<ul class="list-unstyled">';
                serviciosArray.forEach(function (servicio) {
                    listaServiciosHtml += `<li><i class="bi bi-check-circle-fill text-success"></i> ${servicio.trim()}</li>`;
                });
                listaServiciosHtml += '</ul>';

                // Agregar la lista al contenedor deseado en tu HTML
                document.getElementById('contenedorServicios2').innerHTML = listaServiciosHtml;

            },
            error: function (xhr, status, error) {
                debugger
                console.error('Error al obtener el proyecto:', error);
            }
        });
    });


    //guardado de la informacion
    $('#guardarCotizacion').on('submit', function (e) {
        debugger
        e.preventDefault();

        let fechaInicio = $('#fechaInicio').val();
        // Enviar los datos usando AJAX
        $.ajax({
            url: $(this).attr('action'), // Ajusta la URL para que coincida con tu ruta
            method: $(this).attr('method'),
            data: {
                proyecto_id: id_proyecto,
                unidad_id: unidadId,
                nombre: nombre,
                apellido: apellido,
                tipo_cliente: tipoCliente,
                celular: celular,
                correo: correo,
                primer_pago: primerPago,
                tipo_renta: convertirTipoRenta(tipoRenta),
                duracion: duracion,
                fecha_inicio: fechaInicio,
                total: total,
                _token: $('meta[name="csrf-token"]').attr('content') // Asegúrate de incluir el token CSRF
            },
            success: function (response) {
                alert('Cotización creada exitosamente.');
                window.location.href = '/cotizacion'; // Redirigir a la lista de proyectos

            },
            error: function (xhr) {
                alert('Hubo un error al crear la cotización.');
            }
        });
    });


    // Detectar cambios en el select
    $('#tiempo').on('change', function () {
        calcularCotizacion();
    });

    $('#inputTiempoCotizacion').on('input', function () {
        calcularCotizacion();
    });


});


//hace el calculo de la cotizacion aproximada
function calcularCotizacion() {
    tipoRenta = $('#tiempo').val(); // Define si es año, hora o mes
    duracion = parseFloat($('#inputTiempoCotizacion').val());
    total = 0;

    if (tipoRenta == "años")
        total = (parseFloat(mesRenta) * 12) * duracion;


    if (tipoRenta == "horas")
        total = parseFloat(horaRenta) * duracion;

    if (tipoRenta == "meses")
        total = parseFloat(mesRenta) * duracion;

    $('#Txtcotizacion').text('$' + total.toFixed(2));
}


//parseo /conversion al correcto como esta en el enumerador de base
function convertirTipoRenta(tipoRenta) {
    switch(tipoRenta) {
        case 'años':
            return 'año'; // Asumiendo que no necesitas "año" en tu validación
        case 'horas':
            return 'hora';
        case 'meses':
            return 'mes';
        default:
            return tipoRenta; 
    }
}