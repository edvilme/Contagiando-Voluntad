<?php
    include_once "../models/user.php";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo "Get user";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "Post user";
    }
?>