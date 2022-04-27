<?php
include_once('../models/campaign.php');
session_start();
$current_user = unserialize($_SESSION["authenticated_user"]);


// Get campaign id
$campaign_id = $_GET['id'];
if(!isset($campaign_id)) return header('Location: ./404.php');
// Get campaign from ID
$campaign = $campaign_id == 'new' ? new Campaign([]) : Campaign::getByID($campaign_id);
if(!isset($campaign)) return header('Location: ./404.php');

$campaignUser = $campaign->getCreatorUser() ?? $current_user;
$campaignItems = $campaign->getItems();
$campaignRecipients = array_filter($campaignItems, function ($item) {
    return $item->type == 'recipient';
});
$campaignCatalog = array_filter($campaignItems, function ($item) {
    return $item->type == 'catalog';
})
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        #recipients>.card {
            width: 400px;
        }
    </style>

</head>

<body>

    <form action="<?=  $campaign_id == 'new' ? '/api/campaigns/' : '/api/campaigns/'.$campaign_id.'/update' ?>" method="POST" class="container card">
        <h1>Datos de campaña</h1>
        <div class="mb-3 form-floating">
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $campaign->name ?>">
            <label for="name">Nombre de campaña</label>
        </div>

        <div class="mb-3 form-floating">
            <textarea name="description" id="description" class="form-control"><?php echo $campaign->description ?></textarea>
            <label for="description">Descripción de la campaña</label>
        </div>

        <div class="row">
            <div class="col mb-3 form-floating">
                <input type="date" name="start-date" id="start-date" class="form-control" value="<?= date("Y-m-d", strtotime($campaign->start_date)); ?>">
                <label for="start-date">Fecha de inicio</label>
            </div>
            <div class="col mb-3 form-floating">
                <input type="date" name="end-date" id="end-date" class="form-control" value="<?= date("Y-m-d", strtotime($campaign->end_date)); ?>">
                <label for="end-date">Fecha de fin</label>
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>
    <br>

    <div class="card container">
        <h1>Encargado de campaña</h1>
        <div class="row">
            <div class="col">
                <div class="mb-3 form-floating">
                    <input disabled class="form-control" value="<?= $campaignUser->name; ?>">
                    <label>Nombre</label>
                </div>
            </div>
            <div class="col">
                <div class="mb-3 form-floating">
                    <input disabled class="form-control" value="<?= $campaignUser->last_name; ?>">
                    <label>Apellido(s)</label>
                </div>
            </div>
        </div>
        <div class="mb-3 form-floating">
            <input type="email" name="campaignUserEmail" id="campaignUserEmail" class="form-control" value="<?= $campaignUser->email; ?>">
            <label for="campaignUserEmail">Correo electrónico</label>
        </div>
        <div class="mb-3 form-floating">
            <input disabled class="form-control" value="<?= $campaignUser->tel; ?>">
            <label for="campaignUserEmail">Número telefónico</label>
        </div>
    </div>

    <br>

    <div class="card container">
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

                <div class="list-group list-group-flush">
                    <?php foreach ($campaignRecipients as $key => $recipient) : ?>
                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <?= $recipient->name; ?>
                            <div class="btn-group">
                                <a href="" class="btn btn-info">Editar...</a>
                                <a href="" class="btn btn-danger">Eliminar...</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="mb-3">
                    <button class="btn btn-primary">Agregar beneficiario...</button>
                </div>
            </div>
            <div class="tab-pane fade" id="catalog" role="tabpanel" aria-labelledby="catalog-tab">

                <div class="list-group list-group-flush">
                    <?php foreach ($campaignCatalog as $key => $item) : ?>
                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <?= $item->name; ?>
                            <div class="btn-group">
                                <a href="" class="btn btn-info">Editar...</a>
                                <a href="" class="btn btn-danger">Eliminar...</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="mb-3">
                    <button class="btn btn-primary">Agregar elemento de catálogo...</button>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card container">
        <h2>Donaciones</h2>
    </div>

</body>

</html>