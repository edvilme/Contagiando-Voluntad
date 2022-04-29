<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');

$user_email = $_GET['user_email'];
$user = User::getByEmail($user_email);

$donations;
if ($user != null) $donations = $user->getDonations();

?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<h2>Buscar usuario por correo electrónico</h2>
				</div>
				<div class="row g-3">
					<form class="input-group" action="" method="GET">
						<input type="email" name="user_email" id="user_email" placeholder="Email" class="form-control" value="<?= $user_email ?>">
						<input type="submit" value="Buscar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<?php if ($user != null) : ?>

			<div class="card">
				<div class="card-body">
					<form action="/api/users/<?= $user->user_id; ?>/update" method="POST" id="user-update-form">
						<div class="mb-3">
							<h2>Datos personales</h2>
						</div>
						<div class="row">
							<div class="col">
								<div class="mb-3 form-floating">
									<input type="text" name="name" id="name" class="form-control" required value="<?= $user->name; ?>">
									<label for="name">Nombre(s) *</label>
								</div>
							</div>
							<div class="col">
								<div class="mb-3 form-floating">
									<input type="text" name="last_name" id="last_name" class="form-control" required value="<?= $user->last_name; ?>">
									<label for="last_name">Apellido *</label>
								</div>
							</div>
						</div>
						<div class="mb-3 form-floating">
							<input type="date" name="birthdate" id="birthdate" class="form-control" required value="<?= date("Y-m-d", strtotime($user->birthdate)); ?>">
							<label for="birthdate">Fecha de nacimiento *</label>
						</div>
						<div class="mb-3 form-floating">
							<select name="location" id="location" class="form-control" required>
								<?php
								$estados = [
									"Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", "Chihuahua", "Coahuila", "Colima",
									"Ciudad de México", "Durango", "Estado de México", "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "Michoacán", "Morelos",
									"Nayarit", "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", "Tabasco",
									"Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
								];
								foreach ($estados as $key => $estado) :
								?>
									<option value="<?= $estado ?>" <?= $estado == $user->location ? "selected" : "" ?>><?= $estado ?></option>
								<?php endforeach; ?>
							</select>
							<label for="location">Estado *</label>
						</div>
						<div class="mb-3">
							<h2>Datos de contacto</h2>
						</div>
						<div class="mb-3 form-floating">
							<input type="email" name="email" id="email" class="form-control" required value="<?= $user->email; ?>">
							<label for="email">Correo electrónico *</label>
						</div>
						<div class="mb-3 form-floating">
							<input type="tel" name="tel" id="tel" class="form-control" value="<?= $user->tel; ?>">
							<label for="tel">Teléfono</label>
						</div>
						<div class="mb-3">
							<h2>Rol</h2>
							<div class="input-group">
								<input type="radio" name="type" id="typeUser" class="btn-check" value="user" <?= $user->type == "user" ? "checked" : ""; ?>>
								<label for="typeUser" class="btn btn-outline-dark">Usuario regular</label>
								<input type="radio" name="type" id="typeAdmin" class="btn-check" value="admin" <?= $user->type == "admin" ? "checked" : ""; ?>>
								<label for="typeAdmin" class="btn btn-outline-dark">Usuario administrador</label>
							</div>
						</div>
						<hr>
						<div class="mb-3">
							<input type="submit" value="Actualizar" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Campaña</th>
								<th>Concepto</th>
								<th>Descripción</th>
								<th>Fecha</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($donations as $key => $donation) : ?>
								<tr>
									<td><?= $donation->donation_id ?></td>
									<td>
										<a href="./campaña.php?id=<?= $donation->campaign_id ?>"><?= "(".$donation->campaign_id.") ".(Campaign::getByID($donation->campaign_id)->name); ?></a>
									</td>
									<td><?= $donation->concept ?></td>
									<td><?= $donation->description ?></td>
									<td> <?= date("Y-m-d", strtotime($donation->date)); ?> </td>
									<td> <a href="" class="btn btn-secondary">Editar...</a> </td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>


	</div>
</div>




<!--/contenido de la pagina-->
<?php
include_once '../partials/footer.php';
?>

<script src="../js/form-control.js"></script>
<script>
	document.querySelector('#user-update-form').addEventListener('submit', async e => {
		e.preventDefault();
		const response = await submitFormAsync(document.querySelector('#user-update-form'));
		if (response?.email) window.location.reload();
	})
</script>

</body>

</html>