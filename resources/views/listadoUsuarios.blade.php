<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial;
            background: #e9edf2;
            height: 100vh;
            overflow: hidden;
        }

        .main {
            display: flex;
            height: 100vh;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            width: 230px;
            background: #2f5876;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px 15px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 25px;
        }

        .menu-item {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .menu-item.active,
        .menu-item:hover {
            background: #24465f;
        }

        /* ---------- CONTENIDO ---------- */
        .contenido {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* ---------- LISTADO ---------- */
        .listado {
            flex: 1;
            padding: 25px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .listado h1 {
            margin: 0;
            color: #29485f;
        }

        /* filtros */
        .barra-filtros {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
        }

        .filtro-rol {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filtro-rol select {
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #ccd6df;
        }

        .buscador input {
            padding: 7px;
            border-radius: 6px;
            border: 1px solid #ccd6df;
            width: 200px;
        }

        /* ---------- SCROLL ---------- */
        .lista-scroll {
            flex: 1;
            overflow-y: auto;
        }

        /* grid cuando no hay detalle */
        .modo-grid .lista-scroll {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* lista cuando hay detalle */
        .modo-lista .lista-scroll {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .usuario-card {
            background: #dce7ef;
            border-radius: 14px;
            padding: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.12);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .usuario-info {
            display: flex;
            gap: 50px;
        }

        .avatar {
            border-radius: 50%;
            height: 100px;
        }

        .btn-detalle {
            background: #5e7f98;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            cursor: pointer;
        }

        /* ---------- PANEL DERECHO ---------- */
        .detalle {
            width: 40%;
            background: #9fb6c7;
            padding: 25px;
            border-radius: 25px 0 0 25px;
            overflow-y: auto;
        }

        .panel-detalle input {
            width: 100%;
            padding: 9px;
            border: none;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .panel-detalle button {
            background: #4f748e;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
        }

        /* ---------- BOTONES INFERIORES ---------- */
        .barra-acciones {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 12px 0 5px;
        }

        .btn-accion {
            background: #5e7f98;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .btn-accion:hover {
            background: #4f6d83;
        }

        .btn-eliminar {
            background: #b85454;
        }

        .btn-eliminar:hover {
            background: #9e3f3f;
        }
    </style>
</head>

<body>

    <div class="main">

        <div class="sidebar">
            <h3>TRANSITPORT</h3>

            <div class="menu-item">Grúas</div>
            <div class="menu-item">Patio</div>
            <div class="menu-item active">Usuarios</div>
            <div class="menu-item">Órdenes</div>
            <div class="menu-item">Contenedores</div>
            <div class="menu-item">Buques</div>

            <div style="margin-top:auto" class="menu-item">Salir</div>
        </div>

        <div class="contenido">

            @php
            $todos = $gestores->concat($administrativos)->concat($operarios);
            @endphp

            <div class="listado {{ $usuarioSeleccionado ? 'modo-lista' : 'modo-grid' }}">

                <h1>Listado de usuarios</h1>

                <div class="barra-filtros">
                    <div class="filtro-rol">
                        <span>Filtrar por:</span>
                        <select id="filtroRol">
                            <option value="">Todos</option>
                            <option value="gestor">Gestor</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="operario">Operario</option>
                        </select>
                    </div>

                    <div class="buscador">
                        <input type="text" id="busqueda" placeholder="Buscar usuario">
                    </div>
                </div>

                <div class="lista-scroll">

                    @foreach ($todos as $usuario)
                    <div class="usuario-card"
                        data-nombre="{{ strtolower($usuario->name) }}"
                        data-rol="{{ strtolower($usuario->rol) }}"
                        data-id="{{ $usuario->id }}">

                        <div class="usuario-info">
                            <img src="{{ $usuario->imagen }}" class="avatar">
                            <div>
                                <strong>{{ $usuario->name }}</strong>
                                <strong> {{ $usuario->apellidos }}</strong><br><br>
                                <small>Rol: {{ ucfirst($usuario->rol) }}</small>
                            </div>
                        </div>

                        <form method="GET" action="{{ route('listadoUsuarios') }}">
                            <input type="hidden" name="id" value="{{ $usuario->id }}">
                            <input type="hidden" name="rol" value="{{ $usuario->rol }}">
                            <button class="btn-detalle">Detalles</button>
                        </form>

                    </div>
                    @endforeach

                </div>

                <div class="barra-acciones">
                    <form action="{{ route('registrarinicio') }}" method="GET">
                        <button class="btn-accion">Añadir usuario +</button>
                    </form>

                    <button class="btn-accion btn-eliminar">Eliminar usuario</button>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit">Salir</button>
                    </form>

                </div>

            </div>

            @if ($usuarioSeleccionado)
            <div class="detalle">
                <div class="panel-detalle">

                    <form method="GET" action="{{ route('listadoUsuarios') }}">
                        <button>← Volver</button>
                    </form>

                    <h2>Detalles del usuario</h2>

                    <form method="POST" action="{{ route($rol . '_update', $usuarioSeleccionado->id) }}">
                        @csrf
                        @method('PUT')

                        <label>Nombre</label>
                        <input name="name" value="{{ $usuarioSeleccionado->name }}" disabled>

                        <label>Apellidos</label>
                        <input name="apellidos" value="{{ $usuarioSeleccionado->apellidos }}" disabled>

                        <label>Email</label>
                        <input name="email" value="{{ $usuarioSeleccionado->email }}" disabled>

                        <label>Teléfono</label>
                        <input name="telefono" value="{{ $usuarioSeleccionado->telefono }}" disabled>

                        <label>Observaciones</label>
                        <input name="observaciones" value="{{ $usuarioSeleccionado->observaciones }}" disabled>

                        <button type="button" onclick="activarEdicion()">Editar</button>
                        <button type="submit" id="btnGuardar" hidden>Guardar</button>

                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>

    <script>
        function activarEdicion() {
            document.querySelectorAll('.panel-detalle input')
                .forEach(el => el.disabled = false);
            document.getElementById('btnGuardar').hidden = false;
        }

        const busqueda = document.getElementById("busqueda");
        const filtroRol = document.getElementById("filtroRol");

        function filtrar() {
            const texto = busqueda.value.toLowerCase();
            const rol = filtroRol.value;

            document.querySelectorAll(".usuario-card").forEach(card => {
                const nombre = card.dataset.nombre.toLowerCase();
                const rolUser = card.dataset.rol;
                const idUser = card.dataset.id.toLowerCase();

                const coincideNombre = nombre.includes(texto);
                const coincideId = idUser.includes(texto);
                const coincideRol = !rol || rolUser === rol;

                card.style.display =
                    ((coincideNombre || coincideId) && coincideRol) ?
                    "flex" :
                    "none";
            });
        }

        busqueda.addEventListener("input", filtrar);
        filtroRol.addEventListener("change", filtrar);
    </script>

</body>

</html>