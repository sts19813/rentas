<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amenidades - Editar</title>
    <x-link></x-link>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <h1>Agregar Amenidad</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('amenidades.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('amenidades.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <x-script />
    <script src="/assets/js/proyecto.js"></script>
</body>

</html>