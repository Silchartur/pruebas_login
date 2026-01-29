<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <h1>Listado de Usuarios</h1>

    <h2>Gestores</h2>
    @if ($gestores->isEmpty())
        <p>No hay gestores.</p>
    @else
        @foreach ($gestores as $gestor)
            <div class="usuario-card">
                <strong>{{ $gestor->name }}</strong><br>
                <small>{{ $gestor->email }}</small><br>
            </div>

            <form method="GET" action="{{ route('listadoUsuarios') }}">
                <input type="hidden" name="tabla" value="gestor">
                <input type="hidden" name="id" value="{{ $gestor->id }}">

                <button type="submit">
                    Ver detalles
                </button>
            </form>
        @endforeach
    @endif

    <h2>Administrativos</h2>
    @if ($administrativos->isEmpty())
        <p>No hay administrativos.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($administrativos as $administrativo)
                    <tr>
                        <td>{{ $administrativo->id }}</td>
                        <td>{{ $administrativo->name }}</td>
                        <td>{{ $administrativo->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Operarios</h2>
    @if ($operarios->isEmpty())
        <p>No hay operarios.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operarios as $operario)
                    <tr>
                        <td>{{ $operario->id }}</td>
                        <td>{{ $operario->nombre }}</td>
                        <td>{{ $operario->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            @if (session('success'))
                swal("Usuario creado", "{{ session('success') }}", "success");
            @endif
        </script>
    @endif

</body>

</html>
