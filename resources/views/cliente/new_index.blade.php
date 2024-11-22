<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Precios por Rango</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Configurar Precios de Renta por Rango de Fechas</h2>
        <table class="table table-bordered mt-3" id="rangos-table">
            <thead>
                <tr>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button class="btn btn-primary" id="add-row-btn">Agregar Rango</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/customParseFormat.js"></script>
    <script>
        dayjs.extend(dayjs_plugin_customParseFormat);

        const tableBody = document.querySelector("#rangos-table tbody");

        const validateRanges = () => {
            const rows = [...tableBody.querySelectorAll("tr")];
            let lastEndDate = null;

            for (const row of rows) {
                const startDate = dayjs(row.querySelector(".start-date").value, "YYYY-MM");
                const endDate = dayjs(row.querySelector(".end-date").value, "YYYY-MM");

                if (!startDate.isValid() || !endDate.isValid()) {
                    alert("Por favor, ingresa fechas válidas.");
                    return false;
                }

                if (startDate.isAfter(endDate)) {
                    alert("La fecha de inicio no puede ser posterior a la fecha de fin.");
                    return false;
                }

                if (lastEndDate && !startDate.isAfter(lastEndDate)) {
                    alert("Los rangos de fechas no pueden traslaparse.");
                    return false;
                }

                if (lastEndDate && !startDate.isSame(lastEndDate.add(1, "month"))) {
                    alert("Debe haber continuidad entre los rangos.");
                    return false;
                }

                lastEndDate = endDate;
            }

            return true;
        };

        const addRow = () => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td><input type="month" class="form-control start-date" required></td>
                <td><input type="month" class="form-control end-date" required></td>
                <td><input type="number" class="form-control price" min="0" required></td>
                <td>
                    <button class="btn btn-danger btn-sm delete-row-btn">Eliminar</button>
                </td>
            `;

            row.querySelector(".delete-row-btn").addEventListener("click", () => {
                row.remove();
            });

            tableBody.appendChild(row);
        };

        document.getElementById("add-row-btn").addEventListener("click", () => {
            addRow();
        });

        document.getElementById("rangos-table").addEventListener("change", validateRanges);
    </script>
</body>
</html>
