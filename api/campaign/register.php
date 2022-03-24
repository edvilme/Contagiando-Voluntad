<?php
    include_once(__DIR__.'/../../models/campaign.php');

    // If method is POST, process data
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Make user_id = null
        $_POST["campaign_id"] = null;
        // Create user using POST data
        $campaign = new Campaign($_POST);
        // Upload user to db
        $campaign->upload_new();
        // Echo success
        echo "Success";
    }
?>