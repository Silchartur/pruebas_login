<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #eef3f7;
        }

        h1 {
            margin: 1rem;
            color: #2c3e50;
        }

        .layout {
            display: grid;
            height: calc(100vh - 80px);
        }

        .layout.sin-detalle {
            grid-template-columns: 1fr;
        }

        .layout.con-detalle {
            grid-template-columns: 380px 1fr;
        }

        .listado {
            background: #f5f9fc;
            padding: 1rem;
            overflow-y: auto;
        }

        .listado h2 {
            color: #34495e;
            margin-top: 1.5rem;
        }

        .usuario-card {
            background: white;
            border-radius: 10px;
            padding: 0.7rem 0.9rem;
            margin-bottom: 0.6rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .usuario-info {
            display: flex;
            flex-direction: column;
        }

        .usuario-info strong {
            font-size: 0.9rem;
        }

        .usuario-info small {
            color: #6c7a89;
        }

        .btn-detalle {
            background: #e9f1f8;
            border: 1px solid #cfd9e2;
            color: #2c3e50;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.75rem;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-detalle:hover {
            background: #dbe7f3;
        }

        
        .detalle {
            background: #cfe0ec;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .panel-detalle {
            width: 420px;
            background: #dbeaf3;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .panel-detalle h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        .panel-detalle label {
            font-size: 0.85rem;
            color: #34495e;
        }

        .panel-detalle input {
            width: 100%;
            padding: 8px;
            border-radius: 10px;
            border: none;
            margin-bottom: 1rem;
        }

        .panel-detalle input:disabled {
            background: #f4f7fa;
        }

        .panel-detalle button {
            background: #5f8fb3;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            cursor: pointer;
        }

        .panel-detalle button:hover {
            background: #4a7a9e;
        }

        .btn-cerrar {
            background: transparent;
            color: #2c3e50;
            border: none;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h1>Listado de Usuarios</h1>

<div class="layout {{ $usuarioSeleccionado ? 'con-detalle' : 'sin-detalle' }}">

    <div class="listado">

        <h2>Gestores</h2>
        @forelse ($gestores as $gestor)
            <div class="usuario-card">
                <div class="usuario-info">
                    <strong>{{ $gestor->name }}</strong>
                    <small>{{ $gestor->email }}</small>
                </div>

                <form method="GET" action="{{ route('listadoUsuarios') }}">
                    <input type="hidden" name="rol" value="gestor">
                    <input type="hidden" name="id" value="{{ $gestor->id }}">
                    <button type="submit" class="btn-detalle">Detalles</button>
                </form>
            </div>
        @empty
            <p>No hay gestores.</p>
        @endforelse

        <h2>Administrativos</h2>
        @forelse ($administrativos as $administrativo)
            <div class="usuario-card">
                <div class="usuario-info">
                    <strong>{{ $administrativo->name }}</strong>
                    <small>{{ $administrativo->email }}</small>
                </div>

                <form method="GET" action="{{ route('listadoUsuarios') }}">
                    <input type="hidden" name="rol" value="administrativo">
                    <input type="hidden" name="id" value="{{ $administrativo->id }}">
                    <button type="submit" class="btn-detalle">Detalles</button>
                </form>
            </div>
        @empty
            <p>No hay administrativos.</p>
        @endforelse

        <h2>Operarios</h2>
        @forelse ($operarios as $operario)
            <div class="usuario-card">
                <div class="usuario-info">
                    <strong>{{ $operario->name }}</strong>
                    <small>{{ $operario->email }}</small>
                </div>

                <form method="GET" action="{{ route('listadoUsuarios') }}">
                    <input type="hidden" name="rol" value="operario">
                    <input type="hidden" name="id" value="{{ $operario->id }}">
                    <button type="submit" class="btn-detalle">Detalles</button>
                </form>
            </div>
        @empty
            <p>No hay operarios.</p>
        @endforelse

    </div>

    @if ($usuarioSeleccionado)
        <div class="detalle">
            <div class="panel-detalle">

                <form method="GET" action="{{ route('listadoUsuarios') }}">
                    <button type="submit" class="btn-cerrar">← Volver</button>
                </form>

                <h2>Detalles del usuario</h2>
                <p><strong>Rol:</strong> {{ ucfirst($rol) }}</p>

                <form method="POST"
                      action="{{ route($rol . '_update', $usuarioSeleccionado->id) }}">
                    @csrf
                    @method('PUT')

                    @php
                        switch ($rol) {
                            case 'gestor':
                                $codigo = 'G-';
                                break;
                            case 'administrativo':
                                $codigo = 'A-';
                                break;
                            case 'operario':
                                $codigo = 'O-';
                                break;
                        }
                    @endphp

                    <p><strong>ID: </strong> {{$codigo . $usuarioSeleccionado->id}}</p>

                    <label>Nombre</label>
                    <input name="name"
                           value="{{ $usuarioSeleccionado->name }}"
                           disabled>

                    <label>Email</label>
                    <input name="email"
                           value="{{ $usuarioSeleccionado->email }}"
                           disabled>

                    <button type="button" onclick="activarEdicion()">
                        Editar
                    </button>

                    <button type="submit" id="btnGuardar" hidden>
                        Guardar
                    </button>
                </form>

            </div>
        </div>
    @endif

</div>

@if (session('success'))
<script>
    swal("Correcto", "{{ session('success') }}", "success");
</script>
@endif

<script>
function activarEdicion() {
    document.querySelectorAll('.panel-detalle input')
        .forEach(el => el.disabled = false);

    document.getElementById('btnGuardar').hidden = false;
}
</script>

</body>
</html>
