$(document).ready(function () {

    function calcularMesDeRenta() {
        const fechaInicio = new Date($('#fechaInicio').val());
        const fechaVencimiento = new Date($('#fechaVencimiento').val());
        const fechaPago = parseInt($('#fechaPago').val(), 10);
        const hoy = new Date();

        // Validar que las fechas sean correctas
        if (isNaN(fechaInicio.getTime()) || isNaN(fechaVencimiento.getTime())) {
            //alert("Por favor, selecciona fechas válidas.");
            return;
        }

        // Asegurar que la fecha actual está dentro del rango
        if (hoy < fechaInicio || hoy > fechaVencimiento) {
            //alert("La fecha actual está fuera del rango de renta.");
            return;
        }

        // Ajustar la fecha de inicio al día de pago
        const fechaInicioAjustada = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth(), fechaPago);

        // Si la fecha ajustada es antes de la fecha de inicio original
        if (fechaInicioAjustada < fechaInicio) {
            fechaInicioAjustada.setMonth(fechaInicioAjustada.getMonth() + 1);
        }

        // Calcular el número total de meses de renta
        const totalMeses = (fechaVencimiento.getFullYear() - fechaInicio.getFullYear()) * 12 +
            (fechaVencimiento.getMonth() - fechaInicio.getMonth()) + 1;

        // Calcular el mes actual de renta
        let mesesTranscurridos = (hoy.getFullYear() - fechaInicioAjustada.getFullYear()) * 12 +
            (hoy.getMonth() - fechaInicioAjustada.getMonth());

        // Ajustar si el día actual es menor al día de pago
        if (hoy.getDate() < fechaPago) {
            mesesTranscurridos--;
        }

        const mesActual = mesesTranscurridos + 1; // Los meses empiezan en 1

        if (mesActual > 0 && mesActual <= totalMeses) {
           
            $('#mesRenta').val(`${mesActual} / ${totalMeses}`)
            
        } else {
            //alert("La fecha actual no corresponde a un mes de renta válido.");
        }
    }

    // Recalcular al cambiar las fechas o el día de pago
    $('#fechaInicio, #fechaVencimiento, #fechaPago').on('change', calcularMesDeRenta);

    $('#guardarCliente').on('submit', function (e) {
        e.preventDefault();

        const clienteData = {
            plaza: $('#proyecto_id').val(),
            local: $('#unidad').val(),

            mes_renta: $('#mesRenta').val(),
            nombre: $('#nombre').val(),
            apellido: $('#apellido').val(),
            fecha_pago: $('#fechaPago').val(),
            mensualidad: $('#mensualidad').val(),
            correo: $('#correo').val(),
            fecha_vencimiento: $('#fechaVencimiento').val(),
            tipo_cliente: $('#tipoCliente').val(),
            celular: $('#celular').val(),

            //direccion cliente
            direccion: $('#direccion').val(),
            pais: $('#pais').val(),
            ciudad_cliente: $('#ciudadCliente').val(),
            estado: $('#estado').val(),
            codigo_postal: $('#codigoPostal').val(),

            //aval
            nombre_aval: $('#nombreAval').val(),
            celular_aval: $('#celularAval').val(),
            relacion_aval: $('#relacionAval').val(),

            //referencias
            nombreR1: $('#nombreR1').val(),
            celularR1: $('#celularR1').val(),
            correoR1: $('#correoR1').val(),
            relacionR1: $('#relacionR1').val(),

            nombreR2: $('#nombreR2').val(),
            celularR2: $('#celularR2').val(),
            correoR2: $('#correoR2').val(),
            relacionR2: $('#relacionR2').val(),

            nombreR3: $('#nombreR3').val(),
            celularR3: $('#celularR3').val(),
            correoR3: $('#correoR3').val(),
            relacionR3: $('#relacionR3').val(),


            primer_pago: $('input[name="primer_pago"]').val(),
            tipo_renta: $('input[name="tipo_renta"]').val(),
            duracion: $('input[name="duracion"]').val(),
            fecha_inicio: $('input[name="fecha_inicio"]').val(),
            total: $('input[name="total"]').val(),


            razon_social: $('#razonSocial').val(),
            rfc: $('#rfc').val(),
            uso_factura: $('#usoFactura').val(),
            regimen_fiscal: $('#regimenFiscal').val(),
            giro_negocio: $('#giroNegocio').val(),
            correo_negocio: $('#correoNegocio').val(),
            cp: $('#cpNegocio').val(),
            direccion_facturacion: $('#direccionFacturacion').val(),
            pais_facturacion: $('#paisFacturacion').val(),
            estado_facturacion: $('#estadoFacturacion').val(),
            ciudad_facturacion: $('#ciudadFacturacion').val(),
            cp_facturacion: $('#cpFacturacion').val(),
            nombre_representante: $('#nombreRepresentante').val(),
            celular_representante: $('#celularRepresentante').val(),
            relacion_representante: $('#relacionRepresentante').val(),


            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: clienteData,
            success: function (response) {
                showToast("success", "Proyecto guardado correctamente");

                setTimeout(function () {
                    window.location.href = '/clientes';
                }, 2000);
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    let errorMessages = '';
                    for (let field in error.responseJSON.errors) {
                        if (error.responseJSON.errors.hasOwnProperty(field)) {
                            errorMessages += error.responseJSON.errors[field].join(', ') + '<br> ';
                        }
                    }
                    showToast("error", errorMessages, 'top-end', 5000);
                } else {
                    showToast("error", "Ha ocurrido un error", 'top-end', 5000);
                }
            }
        });
    });

    //traer todas las unidades del proyecto seleccionado
    $('#proyecto_id').on('change', function () {

        var proyectoId = $(this).val(); // Obtener el ID del proyecto seleccionado

        if (proyectoId) {
            // Hacer la solicitud AJAX para obtener las unidades del proyecto
            $.ajax({
                url: '/proyectos/' + proyectoId + '/unidades', // Ruta al método que retorna las unidades
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Limpiar el select de unidades antes de llenarlo
                    $('#unidad').empty();
                    $('#unidad').append('<option value="">Selecciona una unidad</option>');

                    // Llenar el select de unidades con los datos recibidos
                    response['data'].forEach(function (unidad) {
                        $('#unidad').append('<option value="' + unidad.id + '">' + unidad.nombre + '</option>');
                    });
                },
                error: function () {
                    alert('Error al obtener las unidades.');
                }
            });
        } else {
            // Limpiar el select de unidades si no hay proyecto seleccionado
            $('#unidad').empty();
            $('#unidad').append('<option value="">Selecciona una unidad</option>');
        }
    });


    // Evento para obtener los datos de una unidad cuando se selecciona
    $('#unidad').on('change', function () {

        var unidadId = $(this).val();

        if (unidadId) {
            // Solicitud AJAX para obtener los datos de la unidad seleccionada
            $.ajax({
                url: '/unidades/' + unidadId, // Ruta al método que retorna los datos de la unidad
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Mostrar los datos de la unidad en los campos deseados
                    $('#mensualidad').val(response['data'].precio_por_mes);

                },
                error: function () {
                    alert('Error al obtener los datos de la unidad.');
                }
            });
        } else {
            // Limpiar los campos si no hay unidad seleccionada
            $('#nombreUnidad, #metrosCuadrados, #precioHora, #precioMes, #nivel, #estatus').text('');
        }
    });
});
