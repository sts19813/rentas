
$(document).ready(function () {

    let quillReglamento, quillTerminos;

    // Enviar formulario y extraer los datos de las unidades
    $('#formGuardarProyecto').on('submit', function (e) {

        e.preventDefault();

        let formData = new FormData(this);
        let reglamento = $('#reglamento .ql-editor').html();
        let terminos = $('#terminos .ql-editor').html();
        let unidades = [];

        $('#unidadesTable tbody tr').each(function () {
            let unidad = {
                nombre: $(this).find('.nombre').text().trim(),
                metros_cuadrados: $(this).find('.metros_cuadrados').text().trim(),
                precio_por_hora: $(this).find('.precio_por_hora').text().trim().replace('$', '').replace(',', ''),
                precio_por_mes: $(this).find('.precio_por_mes').text().trim().replace('$', '').replace(',', ''),
                nivel: $(this).find('.nivel').text().trim(),
                estatus: $(this).find('.estatus').text().trim()
            };
            unidades.push(unidad);
        });

        formData.append('unidades', JSON.stringify(unidades));
        formData.append('reglamento', reglamento);
        formData.append('terminos', terminos);


        // Enviar el formulario con AJAX
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                debugger
                alert('Proyecto guardado exitosamente.');
                window.location.href = '/proyectos'; // Redirigir a la lista de proyectos
            },
            error: function (error) {
                debugger
                console.log(error);
                alert('Error al guardar el proyecto.');
            }
        });
    });

    //envia el form para actualizar la info de un proyecto
    $('#formActualizarProyecto').on('submit', function (e) {
        e.preventDefault(); 
        debugger

        let formData = new FormData(this);
        let reglamento = $('#reglamento .ql-editor').html();
        let terminos = $('#terminos .ql-editor').html();
        let unidades = [];

        // Recopilar las unidades como en el código anterior
        $('#unidadesTable tbody tr').each(function () {
            let unidad = {
                nombre: $(this).find('.nombre').text().trim(),
                metros_cuadrados: $(this).find('.metros_cuadrados').text().trim(),
                precio_por_hora: $(this).find('.precio_por_hora').text().trim().replace('$', '').replace(',', ''),
                precio_por_mes: $(this).find('.precio_por_mes').text().trim().replace('$', '').replace(',', ''),
                nivel: $(this).find('.nivel').text().trim(),
                estatus: $(this).find('.estatus').text().trim()
            };
            unidades.push(unidad);
        });

        formData.append('unidades', JSON.stringify(unidades));
        formData.append('reglamento', reglamento);
        formData.append('terminos', terminos);

        // Enviar el formulario con AJAX para actualizar
        $.ajax({
            url: $(this).attr('action'), // Asegúrate de que tenga el endpoint correcto con el ID, ej. '/proyectos/1'
            method: 'POST', // Usa POST pero define el método PUT/PATCH con un _method en Laravel
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert('Proyecto actualizado exitosamente.');
                window.location.href = '/proyectos'; // Redirigir a la lista de proyectos
            },
            error: function (error) {
                console.log(error);
                alert('Error al actualizar el proyecto.');
            }
        });
    });



    //carga las unidades de un archivo de excel y los agrega en la tabla
    document.getElementById('excelFile').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: 'array' });

            // Leer la primera hoja del archivo
            const sheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[sheetName];

            // Convertir a JSON
            const jsonData = XLSX.utils.sheet_to_json(worksheet);

            debugger

            insertDataToTable(jsonData);

        };

        reader.readAsArrayBuffer(file);
    });


    //inserta cada registro de unidades a la tabla para ser guardado en la  base de datos
    function insertDataToTable(data) {

        debugger
        const tableBody = document.querySelector("#unidadesTable tbody");

        // Limpiar el contenido del tbody antes de agregar nuevas filas
        tableBody.innerHTML = "";

        // Iterar sobre los registros del JSON
        data.forEach(item => {
            const row = document.createElement("tr");

            // Crear columnas con los datos
            row.innerHTML = `
                <td class="nombre">${item.Nombre || ''}</td>
                <td class="metros_cuadrados">${item.M2 || ''}</td>
                <td class="precio_por_hora">${item['Precio x Hora'] || ''}</td>
                <td class="precio_por_mes">${item['Precio x Mes'] || ''}</td>
                <td class="nivel">${item.Nivel || ''}</td>
                <td class="estatus"><span class="badge ${item.Estatus === 'Disponible' ? 'bg-success' : 'bg-danger'}">${item.Estatus || ''}</span></td>
                <td>
                    <!--button class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button -->
                    <a class="btn btn-danger btn-sm removeRow"><i class="bi bi-trash"></i></a>
                </td>
            `;

            // Agregar la fila al cuerpo de la tabla
            tableBody.appendChild(row);
        });
    }


    let rowIdx = 0;

    // Agregar nueva fila
    $('#addRow').on('click', function () {
        $('#unidadesTable tbody').append(`
            <tr id="R${++rowIdx}">
                <td><input type="number" name="metros_cuadrados" class="form-control metros_cuadrados" required /></td>
                <td><input type="number" step="0.01" name="precio_por_hora" class="form-control precio_por_hora" required /></td>
                <td><input type="number" step="0.01" name="precio_por_mes" class="form-control precio_por_mes" required /></td>
                <td><input type="text" name="nivel" class="form-control nivel" required /></td>
                <td>
                    <select name="planta" class="form-control planta">
                        <option value="baja">Baja</option>
                        <option value="alta">Alta</option>
                    </select>
                </td>
                <td>
                    <select name="estatus" class="form-control estatus">
                        <option value="disponible">Disponible</option>
                        <option value="comprometido">Comprometido</option>
                        <option value="rentado">Rentado</option>
                    </select>
                </td>
                <td><a type="button" class="btn btn-danger removeRow" id="EliminarRow">Eliminar</a></td>
            </tr>
        `);
    });

    // Eliminar una fila
    $('#unidadesTable').on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });


    //visualizador de los mapas
    $('#mapas').on('change', function (event) {
        let previewContainer = $('#preview');
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

    $('#multimedias').on('change', function (event) {
        let previewContainer = $('#preview-multimedias');
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

    quillReglamento = new Quill("#reglamento", {
        theme: "snow",
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["link"]
            ]
        }
    });

    quillTerminos = new Quill("#terminos", {
        theme: "snow",
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["link"]
            ]
        }
    });

});

