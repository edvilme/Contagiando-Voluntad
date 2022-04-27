<?php
include_once('../models/campaign.php');
session_start();
$current_user = unserialize($_SESSION["authenticated_user"]);


// Get campaign id
$campaign_id = $_GET['campaign_id'];
if (!isset($campaign_id)) return header('Location: ./404.php');
// Get campaign from ID
$campaign = Campaign::getByID($campaign_id);
if (!isset($campaign)) return header('Location: ./404.php');

// Get donation id
$donation_id = $_GET['id'];
if (!isset($donation_id)) return header('Location: ./404.php');
$donation = $donation_id == 'new' ? new Donation([]) : Donation::getByID($donation_id);

// Get donor
$donor = $donation->getDonor();

// Get campaign items
$campaignItems = $campaign->getItems();
$campaignRecipients = array_filter($campaignItems, function ($item) {
    return $item->type == 'recipient';
});
$campaignCatalog = array_filter($campaignItems, function ($item) {
    return $item->type == 'catalog';
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <form action="<?= $donation_id == 'new' ? "/api/campaigns/".$campaign_id."/donations" : "/api/campaigns/".$campaign_id."/donations/".$donation_id."/update"; ?>" method="post" class="card container">
        <h1>Datos de donación</h1>

        <div class="mb-3 form-floating">
            <input type="text" name="concept" id="concept" class="form-control" value="<?= $donation->concept; ?>">
            <label for="concept">Concepto</label>
        </div>
        <div class="mb-3 form-floating">
            <textarea name="description" id="description" class="form-control"><?= $donation->description; ?></textarea>
            <label for="description">Descripción</label>
        </div>
        <div class="row">
            <div class="col mb-3">
                <input type="checkbox" class="btn-check" id="validated" name="validated" autocomplete="off" <?= $donation->validated ? "checked" : ""; ?>>
                <label class="btn btn-outline-success" for="validated">Donación verificada</label>
            </div>
            <div class="col mb-3">
                <div class="input-group">
                    <input type="radio" name="type" id="typeMoney" class="btn-check" <?= $donation->type == 'money' ? "checked" : ""; ?> value="money">
                    <label for="typeMoney" class="btn btn-outline-dark">Cantidad monetaria</label>
                    <input type="radio" name="type" id="typeGoods" class="btn-check" <?= $donation->type == 'goods' ? "checked" : ""; ?> value="goods">
                    <label for="typeGoods" class="btn btn-outline-dark">En especie</label>
                </div>
            </div>
        </div>

        <hr>
        <h2>Beneficiario</h2>
        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <div class="form-check">
                    <input type="radio" name="recipient_id" id="recipient-option-0" class="form-check-input" value="0"
                        <?= $donation->recipient_id == "0" ? "checked" : "" ?>
                    >
                    <label for="recipient-option-0"><i> Ninguno </i></label>
                </div>
            </div>
            <?php foreach ($campaignRecipients as $key => $recipient) : ?>
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="radio" name="recipient_id" id="recipient-option-<?= $recipient->campaign_item_id; ?>" class="form-check-input" value="<?= $recipient->campaign_item_id; ?>"
                            <?= $donation->recipient_id ==  $recipient->campaign_item_id ? "checked" : "" ?>
                        >
                        <label for="recipient-option-<?= $recipient->campaign_item_id; ?>"> <?= $recipient->name; ?> </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr>

        <h2>Catálogo</h2>
        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <div class="form-check">
                    <input type="radio" name="item_id" id="recipient-option--1" class="form-check-input" value="0"
                        <?= $donation->item_id == "0" ? "checked" : "" ?>
                    >
                    <label for="recipient-option-0"><i> Ninguno </i></label>
                </div>
            </div>
            <?php foreach ($campaignCatalog as $key => $item) : ?>
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="radio" name="item_id" id="item-option-<?= $item->campaign_item_id; ?>" class="form-check-input" value="<?= $item->campaign_item_id; ?>"
                            <?= $donation->item_id ==  $item->campaign_item_id ? "checked" : "" ?>
                        >
                        <label for="item-option-<?= $item->campaign_item_id; ?>"> <?= $item->name; ?> </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr>
        <div class="mb-3">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>
    <br>
    <div class="card container">
        <h1>Datos de donante</h1>
        <p>
            <a href="">Registrar nuevo donante...</a>
        </p>
        <div class="mb-3 form-floating">
            <input type="email" name="donor_email" id="donor_email" class="form-control" value="<?= $donor->email ?? ""; ?>">
            <label for="donor_email">Correo electrónico de donante</label>
        </div>
    </div>

</body>

</html>