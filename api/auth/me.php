<?php
    include_once(__DIR__.'/../../models/user.php');
    session_start();

    // Get user data
    $user = unserialize($_SESSION["authenticated_user"]);
    // If is type admin or staff
    if(!isset($user) || $user->type == "user")
        die("Error");
    // Else return user
    die(json_encode($user));
?>