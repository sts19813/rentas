$(document).ready(function () {

    $('#guardarCliente').on('submit', function (e) {
        e.preventDefault();
        

    
        const clienteData = {
            proyecto_id: 1,
            unidad_id: 1,
            nombre: $('#nombre').val(),
            apellido: $('#apellido').val(),
            fecha_nacimiento
            tipo_cliente: $('input[name="tipo_cliente"]').val(),
            celular: $('input[name="celular"]').val(),
            correo: $('input[name="correo"]').val(),
            primer_pago: $('input[name="primer_pago"]').val(),
            tipo_renta: $('input[name="tipo_renta"]').val(),
            duracion: $('input[name="duracion"]').val(),
            fecha_inicio: $('input[name="fecha_inicio"]').val(),
            total: $('input[name="total"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content') 
        };

        debugger

        // Captura las referencias
        const referencias = [];
        $('#referencias .referencia').each(function (index, element) {
            const nombreRef = $(element).find('input[name^="referencias[' + index + '][nombre]"]').val();
            const telefonoRef = $(element).find('input[name^="referencias[' + index + '][telefono]"]').val();
            const relacionRef = $(element).find('input[name^="referencias[' + index + '][relacion]"]').val();

            if (nombreRef && telefonoRef && relacionRef) {
                referencias.push({
                    nombre: nombreRef,
                    telefono: telefonoRef,
                    relacion: relacionRef
                });
            }
        });

        // Agrega las referencias al objeto de datos
        clienteData.referencias = referencias;

        // Enviar los datos usando AJAX
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: clienteData,
            success: function (response) {
                showToast("success", "Proyecto guardado correctamente");

                setTimeout(function () {
                    window.location.href = '/cotizacion';
                }, 2000);
            },
            error: function (error) {
                showToast("error", error.responseJSON.message, 'top-end', 5000);
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
