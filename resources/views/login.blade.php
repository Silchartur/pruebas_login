<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: url("./puertoLogin.jpg") no-repeat center center/cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .formulario-div {
        width: 380px;
        padding: 40px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #2A5677;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-size: 14px;
        color: #2A5677;
    }

    input, select {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #0c4a6e;
    }

    .enter-btn {
        width: 100%;
        padding: 12px;
        background: #2A5677;
        color: white;
        border: none;
        border-radius: 8px;
        margin-top: 20px;
        cursor: pointer;
        font-weight: bold;
    }

    .enter-btn:hover {
        background: #082f49;
    }
</style>
</head>

<body>

<div class="formulario-div">
    <h2>TRANSITPORT</h2>

    <form method="POST" action="/login-usuario">
        @csrf

        <div class="form-group">
            <label>Identificación</label>
            <input type="text" name="email" placeholder="Introduce tu email">
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" placeholder="********">
        </div>

        <div class="form-group">
            <select name="rol">
                <option value="">-- Selecciona un rol --</option>
                <option value="gestor" {{ old('rol') == 'gestor' ? 'selected' : '' }}>Gestor</option>
                <option value="administrativo" {{ old('rol') == 'administrativo' ? 'selected' : '' }}>Administrativo</option>
                <option value="operario" {{ old('rol') == 'operario' ? 'selected' : '' }}>Operario</option>
            </select>
        </div>

        <button type="submit" class="enter-btn">ENTRAR</button>
    </form>
</div>

</body>
</html>
