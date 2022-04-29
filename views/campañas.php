<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/campaign.php');
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Campañas</h1>
		<div class="mb-3">
			<button class="btn btn-primary">Agregar nueva campaña...</button>
		</div>
		<div class="card">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre</th>
						<th scope="col">Fecha de inicio</th>
						<th scope="col">Fecha de fin</th>
						<th scope="col">Descripción</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$allCampaigns = Campaign::getAll();
						foreach ($allCampaigns as $key => $campaign):
					?>
						<tr>
							<td><?= $campaign->campaign_id; ?></td>
							<td><?= $campaign->name; ?></td>
							<td><?= date("Y-m-d", strtotime($campaign->start_date)); ?></td>
							<td><?= date("Y-m-d", strtotime($campaign->end_date)); ?></td>
							<td><?= $campaign->description; ?></td>
							<td> <a href="./campaña.php?id=<?=$campaign->campaign_id;?>" class="btn btn-secondary btn-sm">Editar...</a> </td>
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

</body>

</html>