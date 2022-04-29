<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Registrar campaña</h1>
		<div class="card">
			<div class="card-body">
				<form action="/api/campaigns/" method="POST" id="campaign-new-form">
					<div class="mb-3 form-floating">
						<input type="text" name="name" id="name" class="form-control">
						<label for="name">Nombre de campaña</label>
					</div>
					<div class="mb-3 form-floating">
						<textarea name="description" id="description" cols="30" rows="40" class="form-control"></textarea>
						<label for="description">Descripción</label>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="date" name="start_date" id="start_date" class="form-control">
								<label for="start_date">Fecha de inicio</label>
							</div>
						</div>
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="date" name="end_date" id="end_date" class="form-control">
								<label for="end_date">Fecha de fin</label>
							</div>
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
	document.querySelector('#campaign-new-form').addEventListener('submit', async e => {
		e.preventDefault();
		const response = await submitFormAsync(document.querySelector('#campaign-new-form'));
		window.location.href = "/views/campañas.php";
	})
</script>


</body>

</html>