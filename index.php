<?php
    include_once "./models/user.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello world</h1>
    <?php
        $u = new User([
            "name" => "Eduardo",
            "last_name" => "Villalpando",
            "email" => "eduardo.villalpando.mello@gmail.com", 
            "telephone" => "+52 55 5105 3018", 
            "location" => "Mexico City",
            "birthdate" => "2000-06-16T00:00:00.000Z", 
            "password_hash" => "contraseña", 
            "creation_date" => "2022-03-07T15:38:00.000Z"
        ]);
        echo $u->name;
    ?>
</body>
</html>