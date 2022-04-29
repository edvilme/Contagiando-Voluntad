<?php
session_start();
if((isset($_SESSION['authenticated_user']))) header('Location: index.php');
?>

<!doctype html>
<html lang="en" class="light-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

	<!-- CSS Files -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

	<title>Iniciar Sesión </title>
</head>

<body>
	<div class="container">
		<div class="col-xl-4 col-lg-5 col-md-7 mx-auto mt-5">
			<div class="card radius-10">
				<div class="card-body p-4">
					<h1>Iniciar sesión</h1>
					<p>Inicia con tu cuenta</p>

					<form action="/api/auth/login.php" method="POST" id="login-form">
						<div class="mb-3 form-floating">
							<input type="email" name="email" id="email" class="form-control">
							<label for="email">Correo electrónico</label>
						</div>
						<div class="mb-3 form-floating">
							<input type="password" name="password" id="password" class="form-control">
							<label for="password">Contraseña</label>
						</div>
						<div class="mb-3">
							<a href="">¿Olvidaste tu contraseña?</a>
						</div>
						<hr>
						<div class="mb-3">
							<input type="submit" value="Ingresar" class="btn btn-primary">
						</div>
					</form>

				</div>

			</div>
		</div>
	</div>
    <script src="../js/form-control.js"></script>
    <script>
        document.querySelector('#login-form').addEventListener('submit', async e=> {
            e.preventDefault();
            await submitFormAsync(document.querySelector('#login-form'));
            window.location.reload();
        })
    </script>

</body>

</html>