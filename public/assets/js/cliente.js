
dayjs.locale('es'); 
dayjs.extend(dayjs_plugin_customParseFormat);
dayjs.extend(window.dayjs_plugin_isSameOrBefore);
dayjs.extend(window.dayjs_plugin_isSameOrAfter);

const $tableBody = $("#rangos-table tbody");

$(document).ready(function () {

    // Recalcular al cambiar las fechas o el día de pago
    $('#fechaInicio, #fechaVencimiento, #fechaPago').on('change', calcularMesDeRenta);

    //valida las fechas
    $("#rangos-table").on("change", "input", validateRanges);


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


function calcularMesDeRenta() {
    const fechaInicio = new Date($('#fechaInicio').val());
    const fechaVencimiento = new Date($('#fechaVencimiento').val());
    const fechaPago = parseInt($('#fechaPago').val(), 10);
    const hoy = new Date();

    // Validar fechas
    if (isNaN(fechaInicio.getTime()) || isNaN(fechaVencimiento.getTime())) {
        toastr.error('Por favor, selecciona fechas válidas.');
        return;
    }

    if (fechaInicio > fechaVencimiento) {
        toastr.error('La fecha de inicio no puede ser mayor a la fecha de vencimiento.');
        return;
    }

    const fechaInicioAjustada = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth(), fechaPago);

    if (fechaInicioAjustada < fechaInicio) {
        fechaInicioAjustada.setMonth(fechaInicioAjustada.getMonth() + 1);
    }

    const totalMeses = (fechaVencimiento.getFullYear() - fechaInicio.getFullYear()) * 12 +
        (fechaVencimiento.getMonth() - fechaInicio.getMonth());

    // Caso 1: Fecha de inicio en el futuro
    if (hoy < fechaInicio) {
        toastr.info(`Periodo de renta aún no iniciado: 0 / ${totalMeses}`);
        $('#mesRenta').val(`0 / ${totalMeses}`);
        return;
    }

    // Caso 2: Fecha de inicio en el pasado o presente
    let mesesTranscurridos = (hoy.getFullYear() - fechaInicioAjustada.getFullYear()) * 12 +
        (hoy.getMonth() - fechaInicioAjustada.getMonth());

    if (hoy.getDate() < fechaPago) {
        mesesTranscurridos--;
    }

    // Calcular mes actual
    const mesActual = Math.min(mesesTranscurridos + 1, totalMeses); // Limitar al total de meses

    if (mesActual > 0) {
        toastr.success(`${mesActual} / ${totalMeses}`, 'Se configuró correctamente el periodo de renta');
        $('#mesRenta').val(`${mesActual} / ${totalMeses}`);
    } else {
        toastr.error('La fecha actual no corresponde a un mes de renta válido.');
    }
}


//valida la configuracion de los rangos de fechas
const validateRanges = () => {
    const $rows = $tableBody.find("tr");
    const fechaInicioGlobal = dayjs($('#fechaInicio').val(), "YYYY-MM-DD");
    const fechaFinGlobal = dayjs($('#fechaVencimiento').val(), "YYYY-MM-DD");

    if (!fechaInicioGlobal.isValid() || !fechaFinGlobal.isValid()) {
        toastr.error('Por favor, ingresa las fechas de inicio y vencimiento globales válidas.');
        return false;
    }

    let lastEndDate = null;

    if ($rows.length === 0) {
        toastr.error('No se han ingresado rangos de fechas.');
        return false;
    }

    for (let i = 0; i < $rows.length; i++) {
        const $row = $($rows[i]);
        const startDate = dayjs($row.find(".start-date").val(), "YYYY-MM");
        const endDate = dayjs($row.find(".end-date").val(), "YYYY-MM");

        if (!startDate.isValid() || !endDate.isValid()) {
            toastr.error('Por favor, ingresa fechas válidas en los rangos.');
            return false;
        }

        if (startDate.isAfter(endDate)) {
            toastr.error('La fecha de inicio no puede ser posterior a la fecha de fin en un rango.');
            return false;
        }

        if (lastEndDate && !startDate.isAfter(lastEndDate)) {
            toastr.error('Los rangos de fechas no pueden traslaparse.');
            return false;
        }

        if (lastEndDate && !startDate.isSame(lastEndDate.add(1, "month"))) {
            toastr.error('Debe haber continuidad entre los rangos.');
            return false;
        }

        lastEndDate = endDate;

        // Validar que la primera fecha de inicio coincida con la fecha global de inicio
        if (i === 0 && !startDate.isSame(fechaInicioGlobal, "month")) {
            toastr.error('La primera fecha de inicio debe coincidir con la fecha de inicio configurada.');
            return false;
        }

        // Validar que la última fecha de fin coincida con la fecha global de fin
        if (i === $rows.length - 1 && !endDate.isSame(fechaFinGlobal, "month")) {
            toastr.error('La última fecha de fin debe coincidir con la fecha de vencimiento configurada.');
            return false;
        }
    }

    toastr.success('Los rangos de fechas son válidos y coinciden con las fechas globales.');
    return true;
};


//añade una nueva fila apra configurar los rangos de fechas
const addRow = () => {
    const $row = $(`
        <tr>
            <td><input type="month" class="form-control start-date" required></td>
            <td><input type="month" class="form-control end-date" required></td>
            <td><input type="number" class="form-control price" min="0" required></td>
            <td>
                <button class="btn btn-danger btn-sm delete-row-btn">Eliminar</button>
            </td>
        </tr>
    `);

    $row.find(".delete-row-btn").on("click", function () {
        $row.remove();
    });

    $tableBody.append($row);
};


$("#add-row-btn").on("click", addRow);


$("#amortizacion").on("click", function () {
debugger
    validateRanges();
    const $tableBody = $("#amortizacion-table tbody");
    $tableBody.empty();

    const fechaInicioGlobal = dayjs($("#fechaInicio").val(), "YYYY-MM-DD");
    const fechaFinGlobal = dayjs($("#fechaVencimiento").val(), "YYYY-MM-DD");
    const fechaPago = parseInt($("#fechaPago").val(), 10); // Día de pago (ejemplo: 1, 15, 30)

    if (!fechaInicioGlobal.isValid() || !fechaFinGlobal.isValid()) {
        toastr.error("Las fechas globales de inicio y vencimiento no son válidas.");
        return;
    }

    const $ranges = $("#rangos-table tbody tr");
    if ($ranges.length === 0) {
        toastr.error("No hay rangos de fechas configurados.");
        return;
    }

    let currentMonth = fechaInicioGlobal.clone();

    $ranges.each(function () {
        const $range = $(this);
        const rangeStart = dayjs($range.find(".start-date").val(), "YYYY-MM");
        const rangeEnd = dayjs($range.find(".end-date").val(), "YYYY-MM");
        const price = parseFloat($range.find(".price").val());

        if (!rangeStart.isValid() || !rangeEnd.isValid() || isNaN(price)) {
            toastr.error("Hay errores en los rangos de fechas o precios.");
            return false; // Salir del bucle
        }

        while (currentMonth.isBefore(rangeEnd) || currentMonth.isSame(rangeEnd)) {

            const fechaPagoMes = currentMonth.date(fechaPago);
            $tableBody.append(`
                <tr>
                    <td>${currentMonth.format("MMMM YYYY")}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${fechaPagoMes.format("DD/MM/YYYY")}</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-row-btn">Eliminar</button>
                    </td>
                </tr>
            `);
            currentMonth = currentMonth.add(1, "month");
        }
    });

    if (currentMonth.isBefore(fechaFinGlobal)) {
        toastr.error("La configuración no cubre todo el rango entre las fechas globales.");
    }
});


