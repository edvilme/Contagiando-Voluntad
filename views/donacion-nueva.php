<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');
include_once('../models/campaign.php');
include_once('../models/donation.php');

$campaign_id = $_GET['campaign_id'] ?? "";
$campaign = Campaign::getByID($campaign_id);

$donor_email = $_GET['donor_email'] ?? "";
$donor = User::getByEmail($donor_email);
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Registrar donación</h1>

		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<h2>Buscar campaña por ID</h2>
				</div>
				<div class="row g-3">
					<form class="input-group" action="" method="GET">
						<!-- Input hidden to preserve user id -->
						<input type="hidden" name="donor_email" value="<?= $donor_email ?>">
						<input type="text" name="campaign_id" id="campaign_id" placeholder="ID de campaña" class="form-control" value="<?= $campaign_id ?>">
						<input type="submit" value="Buscar" class="btn btn-primary">
					</form>
				</div>
				<hr>
				<?php if ($campaign != null) : ?>
					<div class="mb-3 form-floating">
						<input type="text" name="campaign_name" id="campaign_name" class="form-control" disabled value="<?= $campaign->name; ?>">
						<label for="campaign_name">Nombre de la campaña</label>
					</div>
				<?php else: ?>
					<div class="mb-3">
						<p>No existe ninguna campaña con este ID</p>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<h2>Datos de donante</h2>
				</div>
				<form class="input-group" id="donor-details" action="" method="GET">
					<!-- Input hidden to preserve campaign id -->
					<input type="hidden" name="campaign_id" value="<?= $campaign_id ?>">
					<input type="email" name="donor_email" id="donor_email" placeholder="Email" class="form-control"
						value="<?= $donor_email ?>"
					>
					<input type="submit" value="Buscar" class="btn btn-primary">
				</form>
				<hr>
				<?php if($donor != null) : ?>
					<div class="row">
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="name" id="name" class="form-control" disabled
									value="<?= $donor->name; ?>"
								>
								<label for="name">Nombre(s)</label>
							</div>
						</div>
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="last_name" id="last_name" class="form-control" disabled
									value="<?= $donor->last_name; ?>"
								>
								<label for="last_name">Apellido</label>
							</div>
						</div>
					</div>
					<div class="mb-3 form-floating">
						<input type="date" name="birthdate" id="birthdate" class="form-control" disabled
							value="<?= date("Y-m-d", strtotime($donor->birthdate)); ?>"
						>
						<label for="birthdate">Fecha de nacimiento</label>
					</div>
					<div class="mb-3 form-floating">
						<input type="text" name="location" id="location" class="form-control" disabled
							value="<?= $donor->location; ?>"
						>
						<label for="location">Ubicación</label>
					</div>
				<?php else: ?>
					<div class="mb-3">
						<p>No existe ningún usuario registrado con este correo electrónico</p>
						<a href="./usuario-nuevo.php" class="btn btn-secondary">Registrar nuevo donante...</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

				
		<?php if($donor != null && $campaign != null) : ?>
			<div class="card">
				<div class="card-body">
					<form action="/api/campaigns/<?= $campaign->campaign_id ?>/donations" method="POST" id="donation-new-form">
						<input type="hidden" name="donor_id" value="<?= $donor->user_id; ?>">
						<input type="hidden" name="campaign_id" value="<?= $campaign->campaign_id; ?>">
						<input type="hidden" name="invite_id" value="0">
						<input type="hidden" name="recipient_id" value="0">
						<input type="hidden" name="item_id" value="0">
						<div class="mb-3">
							<h2>Datos de donación</h2>
						</div>
						<div class="mb-3 form-floating">
							<input type="text" name="concept" id="concept" class="form-control" required>
							<label for="concept">Concepto</label>
						</div>
						<div class="mb-3 form-floating">
							<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
							<label for="description">Descripción</label>
						</div>
						<hr>
						<div class="mb-3"><input type="submit" value="Registrar" class="btn btn-primary"></div>
					</form>
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
	document.querySelector('#donation-new-form').addEventListener('submit', async e => {
		e.preventDefault();
		const response = await submitFormAsync(document.querySelector('#donation-new-form'));
		if (response?.donation_id) window.location.reload();
	})
</script>

</body>

</html>