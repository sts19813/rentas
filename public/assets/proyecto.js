
$(document).ready(function () {

    var quillReglamento, quillTerminos;


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



    let rowIdx = 0;

    // Agregar nueva fila
    $('#addRow').on('click', function () {
        debugger
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
                <td><button type="button" class="btn btn-danger removeRow">Eliminar</button></td>
            </tr>
        `);
    });

    // Eliminar una fila
    $('#unidadesTable').on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });

    // Enviar formulario y extraer los datos de las unidades
    $('#formGuardarProyecto').on('submit', function (e) {
        
        e.preventDefault();

        let formData = new FormData(this); 
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
                    <button class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </td>
            `;

            // Agregar la fila al cuerpo de la tabla
            tableBody.appendChild(row);
        });
    }


});

