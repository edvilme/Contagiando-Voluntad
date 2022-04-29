<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Usuarios</h1>
		<div class="mb-3">
			<a href="./usuario-nuevo.php" class="btn btn-primary">Agregar nuevo usuario...</a>
		</div>
		<div class="card">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre(s)</th>
						<th scope="col">Apellidos</th>
						<th scope="col">Correo electrónico</th>
						<th scope="col">Rol</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$allUsers = User::getAll();
						foreach ($allUsers as $key => $user):
					?>
						<tr>
							<td><?= $user->user_id ?></td>
							<td><?= $user->name ?></td>
							<td><?= $user->last_name ?></td>
							<td><?= $user->email ?></td>
							<td><?= $user->type == 'user' ? 'Usuario' : 'Admin' ?></td>
							<td> <a href="./usuario.php?user_email=<?=$user->email;?>" class="btn btn-secondary btn-sm">Editar...</a> </td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>


	</div>
</div>




<!--/contenido de la pagina-->
<?php
include_once '../partials/footer.php';
?>
<script src="../js/funciones_us.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tabla").load("../componentes/tabla_us.php");
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#actualizar').click(function() {
			actualiza();
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#eliminar').click(function() {
			eliminar_usuario();
		});
	});
</script>


</body>

</html>