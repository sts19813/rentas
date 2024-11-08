<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
    <aside class="sidebar" id="sidebar">
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Rentas</a></li>
                    <li><a href="#">Cotizaciones</a></li>
                    <li><a href="#">Propiedades</a></li>
                    <li><a href="#" class="active">Clientes</a></li>
                    <li><a href="#">Gastos</a></li>
                    <li><a href="#">Contratos</a></li>
                    <li><a href="#">Colaboradores</a></li>
                </ul>
            </nav>
        </aside>
        <main id="main-content">
            <header>
                <button id="toggle-sidebar" class="toggle-button">☰</button>
                <h1>Clientes</h1>
                <button class="add-button">+ Agregar Nuevo</button>
            </header>
            <div class="search">
                <input type="text" placeholder="Buscar por nombre o propiedad">
            </div>
            <table class="clients-table">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Cliente</th>
                        <th>Negocio</th>
                        <th>Renta</th>
                        <th>Celular</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repetir para cada cliente -->
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Bessie Cooper</td>
                        <td>Mobiliario para Oficinas</td>
                        <td>-</td>
                        <td>(603) 555-0123</td>
                        <td><span class="status prospect">Prospecto</span></td>
                        <td><button class="options">⋮</button></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Jerome Bell</td>
                        <td>El Orden del Caos</td>
                        <td>Plaza Árbol, Local 02</td>
                        <td>(209) 555-0104</td>
                        <td><span class="status active">Activo</span></td>
                        <td><button class="options">⋮</button></td>
                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </main>
    </div>
    

    <script>
           document.getElementById("toggle-sidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("hidden");
            document.getElementById("main-content").classList.toggle("full-width");
        });
    </script>
</body>
</html>
