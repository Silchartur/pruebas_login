<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="formulario-div">
        <h2>TRANSITPORT</h2>
        <img src="/public/Logo.png" alt="" srcset="">

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

        <button type="submit" class="enter-btn">ENTRAR</button>
    </form>
    </div>
</body>
</html>
