<?php
    include_once(__DIR__.'/../../models/user.php');
    // If method is POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get username and password
        $email = $_POST["email"];
        $password = $_POST["password"];
        // If not set
        if(!isset($email) || !isset($password)) echo("Error");
        // Get user
        $user = User::getByEmailAndPassword($email, $password);
        // If login is correct
        if(isset($user)){
            session_start();
            $_SESSION["authenticated_user"] = serialize($user);
            die(json_encode($user));
        } else {
            echo "Error";
        }
    }
?>