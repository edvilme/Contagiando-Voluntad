<?php
    include_once(__DIR__.'/../../models/user.php');
    include_once(__DIR__.'/../../utils.php');
    session_start();
    

    $path = $_SERVER["REQUEST_URI"];
    $current_user = unserialize($_SESSION["authenticated_user"]);
 
    /**
     * POST /api/users/bulkupload
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/users\/)(bulkupload)(?=\/*$)#', $path, $matches)){
        // Read and parse csv
        $file = $_FILES['csv']['tmp_name'];
        $data = utils_CsvToArray($file);
        foreach ($data as $i) {
            // For each row generate user and upload to databse
            $user = new User($i);
            print_r($user);
        }
    }


    /**
     * GET /api/users/:user_id
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/users\/)(\d+)(?=\/*$)#', $path, $matches)){
        $user_id = $matches[1];
        if(isset($user_id)){
            $user = User::getByID($user_id);
            if(!isset($user)) die("404 User not found");
            else die(json_encode($user));
        }
    }

    /**
     * POST /api/users/:user_id/update
     */
    if($_SERVER['REQUEST_METHOD'] == "POST" && preg_match('#(?<=^\/api\/users\/)(\d+)(?=\/update\/*$)#', $path, $matches)){
        $user_id = $matches[1];
        // Only if admin or same user
        if(!isset($current_user) || $current_user->user_id != $user_id || $current_user->type == "user")
            die("Error Unauthorized");
        if(isset($user_id)){
            // Find user
            $user = User::getByID($user_id);
            if(!isset($user)) die("404 User not found");
            // Update fields
            if(!empty($_POST["name"])) $user->name = $_POST["name"];
            if(!empty($_POST["last_name"])) $user->last_name = $_POST["last_name"];
            if(!empty($_POST["tel"])) $user->tel = $_POST["tel"];
            if(!empty($_POST["location"])) $user->location = $_POST["location"];
            if(!empty($_POST["birthdate"])) $user->birthdate = $_POST["birthdate"];
            if(!empty($_POST["password_hash"])) $user->password_hash = $_POST["password_hash"];
            if(!empty($_POST["profile_picture_url"])) $user->profile_picture_url = $_POST["profile_picture_url"];
            if(!empty($_POST["type"])) $user->type = $_POST["type"]; // TODO: Only admins can change this
            if(!empty($_POST["business_id"])) $user->business_id = (int)$_POST["business_id"];
            // Update user
            $user->update();
            die(json_encode($user));

        }
    }

    /**
     * GET /api/users/:user_id/donations
     */
    if($_SERVER['REQUEST_METHOD'] == "GET" && preg_match('#(?<=^\/api\/users\/)(\d+)(?=\/donations\/*$)#', $path, $matches)){
        $user_id = $matches[1];

        if(isset($user_id)){
            // Find user
            $user = User::getByID($user_id);
            if(!isset($user)) die("404 User not found");
            // Get donations
            $donations = $user->getDonations();
            die(json_encode($donations));
        }
    }
?>