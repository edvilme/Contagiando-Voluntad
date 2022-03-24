<?php
    include_once(__DIR__."/../models/user.php");

    $user = User::getByID($_GET["u"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    Hii
    <br>
    <?php
        print_r($user);
    ?>
</body>
</html>