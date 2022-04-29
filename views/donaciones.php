<?php
$page_title = "Ver administradores - Control de usuarios";
require_once  '../partials/header.php';

include_once('../models/campaign.php');
include_once('../models/user.php');
include_once('../models/donation.php');
?>
<!--contenido de la pagina-->
<div class="page-content-wrapper">
	<div class="page-content">
		<h1>Donaciones</h1>
		<div class="mb-3">
			<button class="btn btn-primary">Agregar nueva donación...</button>
		</div>
		<div class="card">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Campaña</th>
						<th scope="col">Donador</th>
						<th scope="col">Concepto</th>
						<th scope="col">Descripción</th>
						<th scope="col">Fecha</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$allDonations = Donation::getAll();
						foreach ($allDonations as $key => $donation):
					?>
						<tr>
							<td> <?= $donation->donation_id; ?> </td>
							<td> 
								<?php 
									$donationCampaign = $donation->getCampaign();
									return "(".$donationCampaign->campaign_id.") ".$donationCampaign->name;
								?>
							</td>
							<td>
								<?php
									$donationDonor = $donation->getDonor();
									return $donationDonor->name." ".$donationDonor->last_name." (".$donationDonor->email.")";
								?>
							</td>
							<td><?= $donation->concept; ?></td>
							<td><?= $donation->description; ?></td>
							<td><?= date("Y-m-d", strtotime($donation->date)); ?></td>
							<td> <a href="./donacion.php?id=<?=$campaign->campaign_id;?>" class="btn btn-secondary btn-sm">Editar...</a> </td>
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