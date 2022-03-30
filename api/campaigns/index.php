<?php

    include_once(__DIR__.'/../../models/user.php');
    include_once(__DIR__.'/../../models/campaign.php');
    include_once(__DIR__.'/../../models/invite.php');
    include_once(__DIR__.'/../../models/donation.php');
    include_once(__DIR__.'/../../utils.php');
    session_start();


    $path = $_SERVER["REQUEST_URI"];
    $current_user = unserialize($_SESSION["authenticated_user"]);


    /**
     * GET /api/campaigns
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#^\/api\/campaigns(\/?)$#', $path, $matches)){
        die(json_encode(
            Campaign::getAll()
        ));
    }


    /**
     * /api/campaigns/bulkupload
     */

    /**
     * GET /api/campaigns/:id/
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/*$)#', $path, $matches)){
        $campaign_id = $matches[1];
        if(isset($campaign_id)){
            $campaign = Campaign::getByID($campaign_id);
            if(!isset($campaign)) die("404 Campaign not found");
            else die(json_encode($campaign));
        }
    }
    
    /**
     * POST /api/campaigns/:id/update
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/update\/?$)#', $path, $matches)){
        // Only if admin
        if(!isset($current_user) || $current_user->type == "user"){
            die("Error unauthorized");
        }
        $campaign_id = $matches[1];
        if(isset($campaign_id)){
            $campaign = Campaign::getByID($campaign_id);
            if(!isset($campaign)) die("404 Campaign not found");
            // Update fields
            if(!empty($_POST["name"])) $campaign->name = $_POST["name"];
            if(!empty($_POST["description"])) $campaign->description = $_POST["description"];
            if(!empty($_POST["start_date"])) $campaign->start_date = $_POST["start_date"];
            if(!empty($_POST["end_date"])) $campaign->end_date = $_POST["end_date"];
            if(!empty($_POST["promotional_picture_url"])) $campaign->promotional_picture_url = $_POST["promotional_picture_url"];
            if(!empty($_POST["badge_picture_url"])) $campaign->badge_picture_url = $_POST["badge_picture_url"];
            if(!empty($_POST["is_public"])) $campaign->is_public = (bool)$_POST["is_public"];
            // Update
            $campaign->update();
            die(json_encode($campaign));
        } 
    }
    /**
     * POST /api/campaigns/:id/invites
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/invites\/?$)#', $path, $matches)){
        // Only if admin
        if(!isset($current_user) || $current_user->type == "user"){
            die("Error unauthorized");
        }
        $campaign_id = $matches[1];
        if(isset($campaign_id)){
            $_POST["campaign_id"] = $campaign_id;
            $_POST["created_by_user_id"] = $current_user->user_id;
            $invite = new Invite($_POST);
            $invite->upload_new();
            die(json_encode($invite));
        }
    }


    /**
     * GET /api/campaigns/:id/invites
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/invites\/?$)#', $path, $matches)){
        // Only if admin
        if(!isset($current_user) || $current_user->type == "user"){
            die("Error unauthorized");
        }
        $campaign_id = $matches[1];
        if(isset($campaign_id)){
            $data = Invite::getAllByCampaignID($campaign_id);
            die(json_encode($data));
        }
    }


    /**
     * POST /api/campaigns/:id/donations
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/donations\/?$)#', $path, $matches)){
        // Only if authenticated
        if(!isset($current_user)) die("Error unauthorized");
        // Campaign id
        $campaign_id = $matches[1];
        if(!isset($campaign_id)) die("Error");
        // Generate donation
        $_POST["campaign_id"] = $campaign_id;
        $donation = new Donation($_POST);
        if(empty($donation->donor_id)) $donation->donor_id = $current_user->user_id;
        // TODO: Check business logic for users vs admins
        $donation->upload_new();
        die(json_encode($donation));
    }

    /**
     * GET /api/campaigns/:id/donations
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/donations\/?$)#', $path, $matches)){
        // Campaign id
        $campaign_id = $matches[1];
        $donations = Donation::getAllByCampaignID($campaign_id);
        die(json_encode($donations));
    }


    /**
     * /api/campaigns/:id/catalog
     * /api/campaigns/:id/recipients
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/(catalog|recipients)\/?$)#', $path, $matches)){
        // Only if admin
        if(!isset($current_user) || $current_user->type == "user"){
            die("Error unauthorized");
        }
        // Campaign id
        $campaign_id = $matches[1];
        $type = $matches[2];
        if(isset($campaign_id) && isset($type)){
            $_POST["campaign_id"] = $campaign_id;
            $_POST["type"] = $type;
            $item = new CampaignItem($_POST);
            $item->upload_new();
            die(json_encode($item));
        }
    }

    /**
     * /api/campaigns/:id/catalog
     * /api/campaigns/:id/recipients
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/campaigns\/)(\d+)(?=\/(catalog|recipients)\/?$)#', $path, $matches)){
        // Campaign id
        $campaign_id = $matches[1];
        $type = $matches[2];
        if(isset($campaign_id) && isset($type)){
            $data = array_slice(array_filter(CampaignItem::getAllByCampaignID($campaign_id), function($row){
                global $type;
                return $row->type == $type;
            }), 0);
            die(json_encode($data));
        }
    }

?>