<?php
include_once "../models/user.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Receive file
    $file = explode("\n", file_get_contents($_FILES['data']['tmp_name']));
    $csv = array_map('str_getcsv', $file);
    $keys = array_shift(($csv));
    
    foreach ($csv as $i=>$row) {
        $csv[$i] = array_combine($keys, $row);
    }
    
    foreach ($csv as $row){
        try{
            $user = new User($row);
            $user->upload_new();
            echo "Datos subidos con éxito";
        } catch(mixed $e){
            echo $e;
        }
    }
}