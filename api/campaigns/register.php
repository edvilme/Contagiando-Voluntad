<?php
    include_once(__DIR__.'/../../models/campaign.php');
    include_once(__DIR__.'/../../models/user.php');
    session_start();
    // Get user data
    $current_user = unserialize($_SESSION["authenticated_user"]);
    // If is type admin or staff
    if(!isset($current_user) || $current_user->type == "user")
        die("Error");
    // If method is POST, process data
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Make user_id = null
        $_POST["campaign_id"] = null;
        // Create user using POST data
        $campaign = new Campaign($_POST);
        // Assign to current user
        $campaign->created_by_user_id = $current_user->user_id;
        // Upload user to db
        $campaign->upload_new();
        // Echo success
        die(json_encode($campaign));
    }
?>