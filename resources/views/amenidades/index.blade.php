<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amenidades</title>
    <x-link></x-link>
</head>
<body>
    <x-header></x-header>
    <div class="container">
        <h1>Amenidades</h1>
        <a href="{{ route('amenidades.create') }}" class="btn btn-primary mb-3">Agregar Amenidad</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($amenidades as $amenidad)
                <tr>
                    <td>{{ $amenidad->id }}</td>
                    <td>{{ $amenidad->nombre }}</td>
                    <td>
                        <a href="{{ route('amenidades.edit', $amenidad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('amenidades.destroy', $amenidad->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-script />
    <script src="/assets/js/proyecto.js"></script>
</body>
</html>