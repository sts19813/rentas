
dayjs.locale('es');
dayjs.extend(dayjs_plugin_customParseFormat);
dayjs.extend(window.dayjs_plugin_isSameOrBefore);
dayjs.extend(window.dayjs_plugin_isSameOrAfter);

const $tableBody = $("#rangos-table tbody");

$(document).ready(function () {
    //valida las fechas
    $("#rangos-table").on("change", "input", validateRanges);


    $('#guardarCliente').on('submit', function (e) {
        e.preventDefault();

        let lastEndDate = null;
        let firstStartDate = null;

        // Recorrer las filas y encontrar la fecha más a futuro
        $('#rangos-table tbody tr').each(function () {
            const startDate = dayjs($(this).find('.start-date').val(), 'YYYY-MM-DD');
            const endDate = dayjs($(this).find('.end-date').val(), 'YYYY-MM-DD');

            if (startDate.isValid()) {
                if (!firstStartDate || startDate.isBefore(firstStartDate)) {
                    firstStartDate = startDate;
                }
            }

            if (endDate.isValid()) {
                // Si no hay una última fecha o la actual es más a futuro, actualizar
                if (!lastEndDate || endDate.isAfter(lastEndDate)) {
                    lastEndDate = endDate;
                }
            }
        });

        const fechaVencimiento = lastEndDate ? lastEndDate.format('YYYY-MM-DD') : null;
        const fechaInicio = firstStartDate ? firstStartDate.format('YYYY-MM-DD') : null;


        const formData = new FormData();

        // Agregar campos individuales del clienteData al FormData
        formData.append('plaza', $('#proyecto_id').val());
        formData.append('local', $('#unidad').val());
        formData.append('nombre', $('#nombre').val());
        formData.append('apellido', $('#apellido').val());
        formData.append('fecha_pago', $('#fechaPago').val());
        formData.append('mensualidad', $('#mensualidad').val());
        formData.append('correo', $('#correo').val());
        formData.append('fecha_vencimiento', fechaVencimiento);
        formData.append('fecha_inicio', fechaInicio);
        formData.append('tipo_cliente', $('#tipoCliente').val());
        formData.append('celular', $('#celular').val());

        // Dirección del cliente
        formData.append('direccion', $('#direccion').val());
        formData.append('pais', $('#pais').val());
        formData.append('ciudad_cliente', $('#ciudadCliente').val());
        formData.append('estado', $('#estado').val());
        formData.append('codigo_postal', $('#codigoPostal').val());

        // Aval
        formData.append('nombre_aval', $('#nombreAval').val());
        formData.append('celular_aval', $('#celularAval').val());
        formData.append('relacion_aval', $('#relacionAval').val());

        // Referencias
        formData.append('nombreR1', $('#nombreR1').val());
        formData.append('celularR1', $('#celularR1').val());
        formData.append('correoR1', $('#correoR1').val());
        formData.append('relacionR1', $('#relacionR1').val());

        formData.append('nombreR2', $('#nombreR2').val());
        formData.append('celularR2', $('#celularR2').val());
        formData.append('correoR2', $('#correoR2').val());
        formData.append('relacionR2', $('#relacionR2').val());

        formData.append('nombreR3', $('#nombreR3').val());
        formData.append('celularR3', $('#celularR3').val());
        formData.append('correoR3', $('#correoR3').val());
        formData.append('relacionR3', $('#relacionR3').val());

        // Otros datos
        formData.append('primer_pago', $('input[name="primer_pago"]').val());
        formData.append('tipo_renta', $('input[name="tipo_renta"]').val());
        formData.append('duracion', $('input[name="duracion"]').val());
        formData.append('total', $('input[name="total"]').val());

        // Datos de facturación
        formData.append('razon_social', $('#razonSocial').val());
        formData.append('rfc', $('#rfc').val());
        formData.append('uso_factura', $('#usoFactura').val());
        formData.append('regimen_fiscal', $('#regimenFiscal').val());
        formData.append('giro_negocio', $('#giroNegocio').val());
        formData.append('correo_negocio', $('#correoNegocio').val());
        formData.append('cp', $('#cpNegocio').val());
        formData.append('direccion_facturacion', $('#direccionFacturacion').val());
        formData.append('pais_facturacion', $('#paisFacturacion').val());
        formData.append('estado_facturacion', $('#estadoFacturacion').val());
        formData.append('ciudad_facturacion', $('#ciudadFacturacion').val());
        formData.append('cp_facturacion', $('#cpFacturacion').val());
        formData.append('nombre_representante', $('#nombreRepresentante').val());
        formData.append('celular_representante', $('#celularRepresentante').val());
        formData.append('relacion_representante', $('#relacionRepresentante').val());

        // Token CSRF
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // Extraer los rangos de fechas
        $('#rangos-table tbody tr').each(function () {
            const startDate = $(this).find('.start-date').val();
            const endDate = $(this).find('.end-date').val();
            const price = $(this).find('.price').val();
        
            if (startDate && endDate && price) {
                // Cada rango se pasa como un objeto JSON
                formData.append('rangos[]', JSON.stringify({
                    start_date: startDate,
                    end_date: endDate,
                    price: parseFloat(price)
                }));
            }
        });


        debugger
        const documentos = document.getElementById('documentos').files;
        for (let i = 0; i < documentos.length; i++) {
            formData.append('documentos[]', documentos[i]);
        }

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                showToast("success", "Cliente guardado correctamente");
        
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


    $('#documentos').on('change', function (event) {
        let previewContainer = $('#preview-documentos');
        previewContainer.empty(); // Limpiar las imágenes previas

        let files = event.target.files; // Obtener archivos seleccionados
        if (files) {
            $.each(files, function (index, file) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    let img = $('<img />', {
                        src: e.target.result,
                        width: '200px', // Ajustar tamaño miniatura
                        class: 'rounded border',
                        css: {
                            margin: '5px',
                            objectFit: 'cover'
                        }
                    });

                    previewContainer.append(img); // Añadir imagen al contenedor
                };

                reader.readAsDataURL(file); // Leer el archivo como URL
            });
        }
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

                        if (unidad.estatus == 'disponible')
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

//valida la configuracion de los rangos de fechas
const validateRanges = () => {
    const $rows = $tableBody.find("tr");

    if ($rows.length === 0) {
        toastr.error('No se han ingresado rangos de fechas.');
        return false;
    }

    let lastEndDate = null;

    for (let i = 0; i < $rows.length; i++) {
        const $row = $($rows[i]);
        const startDate = dayjs($row.find(".start-date").val(), "YYYY-MM-DD");
        const endDate = dayjs($row.find(".end-date").val(), "YYYY-MM-DD");

        if (!startDate.isValid() || !endDate.isValid()) {
            toastr.error(`Por favor, ingresa fechas válidas en los rangos (fila ${i + 1}).`);
            return false;
        }

        if (startDate.isAfter(endDate)) {
            toastr.error(`La fecha de inicio no puede ser posterior a la fecha de fin en el rango de la fila ${i + 1}.`);
            return false;
        }

        if (lastEndDate && !startDate.isAfter(lastEndDate)) {
            toastr.error(`Los rangos de fechas no pueden traslaparse (fila ${i + 1}).`);
            return false;
        }

        if (lastEndDate && !startDate.isSame(lastEndDate.add(1, "day"))) {
            toastr.error(`Debe haber continuidad diaria entre los rangos (error en la fila ${i + 1}).`);
            return false;
        }

        lastEndDate = endDate;
    }

    const firstRowStartDate = dayjs($rows.first().find(".start-date").val(), "YYYY-MM-DD");
    const lastRowEndDate = dayjs($rows.last().find(".end-date").val(), "YYYY-MM-DD");

    if (!firstRowStartDate.isValid() || !lastRowEndDate.isValid()) {
        toastr.error('Las fechas de inicio o fin de los rangos no son válidas.');
        return false;
    }

    toastr.success(`Los rangos de fechas son válidos: 
        Inicio desde ${firstRowStartDate.format("YYYY-MM-DD")} hasta ${lastRowEndDate.format("YYYY-MM-DD")}.`);
    return true;
};




//añade una nueva fila apra configurar los rangos de fechas
const addRow = () => {
    const mensualidadValue = $('#mensualidad').val() || 0;

    const $row = $(`
        <tr>
            <td><input type="date" class="form-control start-date" required></td>
            <td><input type="date" class="form-control end-date" required></td>
            <td><input type="number" class="form-control price" min="0" value="${mensualidadValue}" required></td>
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
    // Validar rangos configurados
    if (!validateRanges()) return;

    const $tableBody = $("#amortizacion-table tbody");
    $tableBody.empty();

    // Obtener fechas mínimas y máximas de los rangos configurados
    const $ranges = $("#rangos-table tbody tr");
    if ($ranges.length === 0) {
        toastr.error("No hay rangos de fechas configurados.");
        return;
    }

    // Calcular fecha mínima (inicio global) y máxima (fin global) de los rangos
    let fechaInicioGlobal = null;
    let fechaFinGlobal = null;

    $ranges.each(function () {
        const rangeStart = dayjs($(this).find(".start-date").val(), "YYYY-MM-DD");
        const rangeEnd = dayjs($(this).find(".end-date").val(), "YYYY-MM-DD");

        if (!rangeStart.isValid() || !rangeEnd.isValid()) {
            toastr.error("Hay errores en los rangos de fechas configurados.");
            return false; // Salir del bucle
        }

        if (!fechaInicioGlobal || rangeStart.isBefore(fechaInicioGlobal)) {
            fechaInicioGlobal = rangeStart;
        }
        if (!fechaFinGlobal || rangeEnd.isAfter(fechaFinGlobal)) {
            fechaFinGlobal = rangeEnd;
        }
    });

    if (!fechaInicioGlobal || !fechaFinGlobal) {
        toastr.error("No se pudo determinar las fechas de inicio y fin.");
        return;
    }

    const fechaPago = parseInt($("#fechaPago").val(), 10); // Día de pago (ejemplo: 1, 15, 30)
    if (isNaN(fechaPago)) {
        toastr.error("El día de pago no es válido.");
        return;
    }

    // Iterar por los rangos y generar filas para amortización
    let currentMonth = fechaInicioGlobal.clone();

    $ranges.each(function () {
        const $range = $(this);
        const rangeStart = dayjs($range.find(".start-date").val(), "YYYY-MM-DD");
        const rangeEnd = dayjs($range.find(".end-date").val(), "YYYY-MM-DD");
        const price = parseFloat($range.find(".price").val());

        if (!rangeStart.isValid() || !rangeEnd.isValid() || isNaN(price)) {
            toastr.error("Hay errores en los rangos de fechas o precios.");
            return false; // Salir del bucle
        }

        // Generar filas solo por mes
        while (currentMonth.isBefore(rangeEnd) || currentMonth.isSame(rangeEnd)) {
            const fechaPagoMes = currentMonth.date(fechaPago); // Fecha con día de pago dentro del mes
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
            currentMonth = currentMonth.add(1, "month"); // Pasar al siguiente mes
        }
    });

    if (currentMonth.isBefore(fechaFinGlobal)) {
        toastr.error("La configuración no cubre todo el rango de fechas entre inicio y fin.");
    }
});



$('.solo-numeros').on('input', function () {
    if (!/^\d*$/.test($(this).val())) {
        $(this).val($(this).val().replace(/\D/g, '')); // Elimina caracteres no numéricos
    }
});
