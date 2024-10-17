<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        h1 {
            text-align: left;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .images {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .images img {
            width: 300px;
            height: auto;
            margin-right: 10px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .left, .right {
            width: 45%;
        }
        .left p, .right p {
            margin: 5px 0;
        }
        .services ul {
            list-style-type: none;
            padding: 0;
        }
        .services ul li::before {
            content: '✔️';
            color: green;
            margin-right: 5px;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cotización: {{ $nombreUnidad }}</h1>
    </div>

    <div class="images">
        <img src="{{ public_path($mapaCotizacion) }}" alt="Mapa Cotización">
        <img src="{{ public_path($mapaMultimedia) }}" alt="Mapa Multimedia">
    </div>

    <div class="info">
        <div class="left">
            <p><strong>Plaza:</strong> {{ $nombrePlaza }}</p>
            <p><strong>Precio de Renta Mes:</strong> ${{ $precioRentaMes }}</p>
            <p><strong>Precio de Renta Hr:</strong> ${{ $precioRentaHr }}</p>
            <p><strong>Primer Pago:</strong> ${{ $primerPago }}</p>
            <p><strong>Tiempo de Renta:</strong> {{ $tiempoRenta }}</p>
            <p class="total"><strong>Total:</strong> ${{ $total }}</p>
        </div>
        <div class="right">
            <p><strong>Hora Apertura:</strong> {{ $horaApertura }}</p>
            <p><strong>Hora Cierre:</strong> {{ $horaCierre }}</p>
        </div>
    </div>

    <div class="services">
        <h3>Incluye:</h3>
        <ul>
            @foreach($servicios as $servicio)
                <li>{{ $servicio }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
