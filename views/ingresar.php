<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
    <form action="/api/auth/login.php" method="post" class="card container">
        <h1>Iniciar sesión</h1>
        <div class="mb-3 form-floating">
            <input type="email" name="email" id="email" class="form-control" placeholder="usuario@mail.com">
            <label for="email">E-mail</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="password" name="password" id="password" class="form-control">
            <label for="password">Contraseña</label>
        </div>
        <hr>
        <div class="mb-3 row">
            <div class="col">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </div>
        </div>
    </form>
</body>
</html>