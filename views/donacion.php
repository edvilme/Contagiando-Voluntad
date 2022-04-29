<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/user.php');
include_once('../models/campaign.php');
include_once('../models/donation.php');

$donation_id = $_GET['id'];
$donation = Donation::getByID($donation_id);

$donor;
if ($donation != null) $donor = $donation->getDonor();
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<h2>Buscar donación por ID</h2>
				</div>
				<div class="row g-3">
					<form class="input-group" action="" method="GET">
						<input type="text" name="id" id="id" placeholder="ID de donación" class="form-control" value="<?= $donation_id ?>">
						<input type="submit" value="Buscar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>

		<?php if ($donation != null) : ?>
			<div class="card">
				<div class="card-body">
					<div class="mb-3">
						<h2>Donante</h2>
					</div>
					<div class="mb-3 form-floating">
						<input type="email" name="name" id="name" class="form-control" disabled value="<?= $donor->email; ?>">
						<label for="name">Correo electrónico</label>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="name" id="name" class="form-control" disabled value="<?= $donor->name; ?>">
								<label for="name">Nombre(s)</label>
							</div>
						</div>
						<div class="col">
							<div class="mb-3 form-floating">
								<input type="text" name="last_name" id="last_name" class="form-control" disabled value="<?= $donor->last_name; ?>">
								<label for="last_name">Apellido</label>
							</div>
						</div>
					</div>
					<div class="mb-3 form-floating">
						<input type="date" name="birthdate" id="birthdate" class="form-control" disabled value="<?= date("Y-m-d", strtotime($donor->birthdate)); ?>">
						<label for="birthdate">Fecha de nacimiento</label>
					</div>
					<div class="mb-3 form-floating">
						<input type="text" name="location" id="location" class="form-control" disabled value="<?= $donor->location; ?>">
						<label for="location">Ubicación</label>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h2>Campaña</h2>
					<a href="./campaña.php?id=<?= $donation->campaign_id; ?>">
						<?php
						$donationCampaign = $donation->getCampaign();
						echo "(" . $donationCampaign->campaign_id . ") " . $donationCampaign->name;
						?>
					</a>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h2>Detalles de la donación</h2>
					<form action="">
						<div class="mb-3 form-floating">
							<input type="date" name="date" id="date" class="form-control" disabled
								value="<?= date("Y-m-d", strtotime($donation->date)); ?>"
							>
							<label for="date">Fecha</label>
						</div>
						<div class="mb-3 form-floating">
							<input type="text" name="concept" id="concept" class="form-control" disabled
								value="<?= $donation->concept; ?>"
							>
							<label for="concept">Concepto</label>
						</div>
						<div class="mb-3 form-floating">
							<textarea name="description" id="description" cols="30" rows="10" class="form-control" disabled><?= $donation->description; ?></textarea>
							<label for="name">Descripción</label>
						</div>
						<hr>
						<div class="mb-3">
							<input type="submit" value="Actualizar" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		<?php else : ?>
			<div class="mb-3">
				<p>No se encontró ninguna donación con ese ID</p>
			</div>
		<?php endif; ?>
	</div>
</div>




<!--/contenido de la pagina-->
<?php
include_once '../partials/footer.php';
?>

</body>

</html>