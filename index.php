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
        $rows = $query->table("User")->select()->get();
        foreach ($rows as $key => $value) {
            # code...
            echo implode(", ", $value);
            echo "<br>";
        }
    ?>
</body>
</html>