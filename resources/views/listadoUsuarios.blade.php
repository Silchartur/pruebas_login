<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
</head>
<body>

    <h1>Listado de Usuarios</h1>

    <h2>Gestores</h2>
    @if($gestores->isEmpty())
        <p>No hay gestores.</p>
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
                @foreach ($gestores as $gestor)
                    <tr>
                        <td>{{ $gestor->id }}</td>
                        <td>{{ $gestor->nombre }}</td>
                        <td>{{ $gestor->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Administrativos</h2>
    @if($administrativos->isEmpty())
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
                        <td>{{ $administrativo->nombre }}</td>
                        <td>{{ $administrativo->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Operarios</h2>
    @if($operarios->isEmpty())
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
                        <td>{{ $operario->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
