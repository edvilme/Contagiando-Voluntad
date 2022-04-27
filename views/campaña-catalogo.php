<?php
    include_once('../models/campaign.php');
    session_start();
    $current_user = unserialize($_SESSION["authenticated_user"]);

    // Get campaign id
    $campaign_id = $_GET['campaign_id'];
    if(!isset($campaign_id)) return header('Location: ./404.php');

    // Get item id
    $item_id = $_GET['id'];
    if(!isset($item_id)) return header('Location: ./404.php');

    // Get item from id
    $item = $item_id == 'new' ? new CampaignItem([]) : CampaignItem::getById($item_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <form action="<?= $item_id == 'new' ? '/api/campaigns/'.$campaign_id.'/catalog' : '/api/campaigns/'.$campaign_id.'/catalog/'.$item_id.'/update' ?>" class="card container" method="post">
        <h1>Datos de producto de catálogo</h1>
        <div class="mb-3 form-floating">
            <input type="text" name="name" id="name" class="form-control" value="<?= $item->name; ?>">
            <label for="name">Nombre</label>
        </div>

        <div class="mb-3 form-floating">
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $item->description; ?></textarea>
            <label for="description">Descripción</label>
        </div>

        <div class="mb-3 input-group">            
            <span class="input-group-text">$</span>
            <input type="number" name="price_equivalent" id="price_equivalent" class="form-control" placeholder="Precio equivalente (MXN)">
            <span class="input-group-text">.00 MXN</span>
        </div>

        <hr>
        <div class="mb-3">
            <label for="photo" class="form-label">Adjuntar imagen...</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <hr>
        <div class="mb-3">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>

</body>

</html>