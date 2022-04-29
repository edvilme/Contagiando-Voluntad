<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/campaign.php');
include_once('../models/user.php');
include_once('../models/donation.php');

$campaign_id = $_GET['id'];
$campaign = Campaign::getByID($campaign_id);

$campaignUser;
$campaignItems;
$campaignRecipients;
$campaignCatalog;
$campaignDonations;

if ($campaign != null) {
	$campaignUser = $campaign->getCreatorUser() ?? $current_user;
	$campaignItems = $campaign->getItems();
	$campaignRecipients = array_filter($campaignItems, function ($item) {
		return $item->type == 'recipient';
	});
	$campaignCatalog = array_filter($campaignItems, function ($item) {
		return $item->type == 'catalog';
	});
	$campaignDonations = $campaign->getDonations();
}
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">

		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<h2>Buscar campaña por ID</h2>
				</div>
				<div class="row g-3">
					<form class="input-group" action="" method="GET">
						<input type="text" name="id" id="id" placeholder="ID" class="form-control" value="<?= $campaign_id ?>">
						<input type="submit" value="Buscar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<?php if ($campaign != null) : ?>
			<div class="card">
				<div class="card-body">
					<form action="/api/campaigns/<?= $campaign->campaign_id; ?>/update" method="POST" id="campaign-update-form">
						<div class="mb-3 form-floating">
							<input type="text" name="name" id="name" class="form-control" value="<?= $campaign->name; ?>">
							<label for="name">Nombre de campaña</label>
						</div>
						<div class="mb-3 form-floating">
							<textarea name="description" id="description" cols="30" rows="40" class="form-control"><?= $campaign->description; ?></textarea>
							<label for="description">Descripción</label>
						</div>
						<div class="row">
							<div class="col">
								<div class="mb-3 form-floating">
									<input type="date" name="start_date" id="start_date" class="form-control" value="<?= date("Y-m-d", strtotime($campaign->start_date)); ?>">
									<label for="start_date">Fecha de inicio</label>
								</div>
							</div>
							<div class="col">
								<div class="mb-3 form-floating">
									<input type="date" name="end_date" id="end_date" class="form-control" value="<?= date("Y-m-d", strtotime($campaign->end_date)); ?>">
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

			<div class="card">
				<div class="card-body">
					<div class="mb-3">
						<h3>Donaciones</h3>
					</div>
					<div class="row">
						<div class="col-auto">
							<div class="mb-3">
								<a href="./donacion-nueva.php?campaign_id=<?= $campaign->campaign_id ?>" class="btn btn-primary">Registrar donación...</a>
							</div>
						</div>
						<div class="col-auto">
							<div class="mb-3">
								<a href="" class="btn btn-primary">Importar desde csv...</a>
							</div>
						</div>
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Donante</th>
								<th>Concepto</th>
								<th>Descripción</th>
								<th>Fecha</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($campaignDonations as $key => $donation) : ?>
								<tr>
									<td> <?= $donation->donation_id; ?> </td>
									<td>
										<?php $donor = User::getByID($donation->donor_id);?>
										<a href="./usuario.php?user_email=<?= $donor->email ?>"><?= $donor->name." ".$donor->last_name." (".$donor->email.")" ?> </a>
									</td>
									<td> <?= $donation->concept; ?> </td>
									<td> <?= $donation->description; ?> </td>
									<td> <?= date("Y-m-d", strtotime($donation->date)); ?> </td>
									<td> <a href="./donacion.php?id=<?= $donation->donation_id; ?>" class="btn btn-secondary">Editar...</a> </td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="recipients-tab" data-bs-toggle="tab" data-bs-target="#recipients" type="button" role="tab" aria-controls="recipients" aria-selected="true">Beneficiarios</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="catalog-tab" data-bs-toggle="tab" data-bs-target="#catalog" type="button" role="tab" aria-controls="catalog" aria-selected="false">Catálogo</button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="recipients" role="tabpanel" aria-labelledby="recipients-tab">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Tipo</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($campaignRecipients as $key => $item) : ?>
										<tr>
											<td> <?= $item->campaign_item_id; ?></td>
											<td> <?= $item->name; ?> </td>
											<td> <?= $item->description; ?> </td>
											<td> Beneficiario </td>
											<td> <button class="btn btn-secondary">Editar...</button> </td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="catalog" role="tabpanel" aria-labelledby="catalog-tab">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Tipo</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($campaignCatalog as $key => $item) : ?>
										<tr>
											<td> <?= $item->campaign_item_id; ?></td>
											<td> <?= $item->name; ?> </td>
											<td> <?= $item->description; ?> </td>
											<td> Catálogo </td>
											<td> <button class="btn btn-secondary">Editar...</button> </td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
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
	document.querySelector('#campaign-update-form').addEventListener('submit', async e => {
		e.preventDefault();
		const response = await submitFormAsync(document.querySelector('#campaign-update-form'));
		window.location.reload();
	})
</script>


</body>

</html>