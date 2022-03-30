<?php
    include_once(__DIR__.'/../../models/user.php');

    // If method is POST, process data
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Make user_id = null
        $_POST["user_id"] = null;
        // Create user using POST data
        $user = new User($_POST);
        // Upload user to db
        $user->upload_new();
        // Set session
        $_SESSION["authenticated_user"] = serialize($user);
        // Echo success
        die(json_encode($user));
    }
?>