<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');
include_once('../models/campaign.php');
include_once('../models/donation.php');
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Registrar donaciones</h1>
		<div class="card">
			<div class="card-body">
				<div class="mb-3 form-floating">
					<select name="type" id="type" class="form-control">
						<option value="users">Usuarios</option>
						<option value="campaigns">Campañas</option>
						<option value="donations">Donaciones</option>
					</select>
					<label for="type">¿Qué tipo de datos quieres subir?</label>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h2>Subir archivo</h2>
				<p>Sube un archivo csv con las columnas designadas para registrar varias donaciones a la vez</p>
				<p>Esta parte aun está en desarrollo</p>
				<div class="mb-3">
					<label for="form-label">Seleccionar archivo</label>
					<input type="file" name="csv" id="csv" class="form-control" required>
				</div>
				<hr>
				<div class="mb-3"><input type="submit" value="Subir" class="btn btn-primary"></div>
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
	/*document.querySelector('#campaign-update-form').addEventListener('submit', async e => {
		e.preventDefault();
		const response = await submitFormAsync(document.querySelector('#campaign-update-form'));
		window.location.reload();
	})*/
</script>


</body>

</html>