<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Registrar usuario</h1>
		<div class="card">
			<div class="card-body">
				<form action="/api/users/new" method="POST" id="new-user-form">
					<div class="mb-3">
						<h2>Datos personales</h2>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="name" id="name" class="form-control" required>
								<label for="name">Nombre(s) *</label>
							</div>
						</div>
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="last_name" id="last_name" class="form-control" required>
								<label for="last_name">Apellido *</label>
							</div>
						</div>
					</div>
					<div class="mb-3 form-floating">
						<input type="date" name="birthdate" id="birthdate" class="form-control" required>
						<label for="birthdate">Fecha de nacimiento *</label>
					</div>
					<div class="mb-3 form-floating">
						<select name="location" id="location" class="form-control" required>
							<option value="Aguascalientes ">Aguascalientes </option>
							<option value="Baja California">Baja California</option>
							<option value="Baja California Sur">Baja California Sur</option>
							<option value="Campeche">Campeche</option>
							<option value="Chiapas">Chiapas</option>
							<option value="Chihuahua">Chihuahua</option>
							<option value="Coahuila">Coahuila</option>
							<option value="Colima">Colima</option>
							<option value="Ciudad de México / CDMX ">Ciudad de México / CDMX</option>
							<option value="Durango">Durango</option>
							<option value="Estado de México">Estado de México</option>
							<option value="Guanajuato">Guanajuato</option>
							<option value="Guerrero">Guerrero</option>
							<option value="Hidalgo ">Hidalgo </option>
							<option value="Jalisco">Jalisco</option>
							<option value="Michoacán">Michoacán</option>
							<option value="Morelos">Morelos</option>
							<option value="Nayarit">Nayarit</option>
							<option value="Nuevo León">Nuevo León</option>
							<option value="Oaxaca">Oaxaca</option>
							<option value="Puebla">Puebla</option>
							<option value="Querétaro">Querétaro</option>
							<option value="Quintana Roo">Quintana Roo</option>
							<option value="San Luis Potosí">San Luis Potosí</option>
							<option value="Sinaloa">Sinaloa</option>
							<option value="Sonora">Sonora</option>
							<option value="Tabasco">Tabasco</option>
							<option value="Tamaulipas">Tamaulipas</option>
							<option value="Tlaxcala">Tlaxcala</option>
							<option value="Veracruz">Veracruz</option>
							<option value="Yucatán">Yucatán</option>
							<option value="Zacatecas">Zacatecas</option>
						</select>
						<label for="location">Estado *</label>
					</div>
					<div class="mb-3">
						<h2>Datos de contacto</h2>
					</div>
					<div class="mb-3 form-floating">
						<input type="email" name="email" id="email" class="form-control" required>
						<label for="email">Correo electrónico *</label>
					</div>
					<div class="mb-3 form-floating">
						<input type="tel" name="tel" id="tel" class="form-control">
						<label for="tel">Teléfono</label>
					</div>
					<div class="mb-3">
						<h2>Datos de inicio de sesión</h2>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="password" name="password_hash" id="password_hash" class="form-control" required>
								<label for="password_hash">Contraseña *</label>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<div class="mb-3 form-floating">
									<input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
									<label for="password_confirm">Confirmar contraseña *</label>
								</div>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<h2>Rol</h2>
						<div class="input-group">
							<input type="radio" name="type" id="typeUser" class="btn-check" value="user">
							<label for="typeUser" class="btn btn-outline-dark">Usuario regular</label>
							<input type="radio" name="type" id="typeAdmin" class="btn-check" value="admin">
							<label for="typeAdmin" class="btn btn-outline-dark">Usuario administrador</label>
						</div>
					</div>
					<hr>
					<div class="mb-3">
						<input type="submit" value="Registrar" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>


	</div>
</div>




<!--/contenido de la pagina-->
<?php
include_once '../partials/footer.php';
?>
<script src="../js/form-control.js"></script>
<script>
	document.querySelector('#new-user-form').addEventListener('submit', async e => {
		e.preventDefault();
		if (e.target.querySelector('#password_hash').value != e.target.querySelector('#password_confirm').value)
			return alert("Las contraseñas no coinciden");

		const response = await submitFormAsync(document.querySelector('#new-user-form'));
		if (response?.email) window.location.href = `/views/usuario.php?user_email=${response?.email}`;
	})
</script>


</body>

</html>