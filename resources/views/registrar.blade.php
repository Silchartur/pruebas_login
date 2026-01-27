<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('registrar') }}">
    @csrf
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="name" class="form-control p_input">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control p_input">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control p_input">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
    </div>

</form>
</body>
</html>
