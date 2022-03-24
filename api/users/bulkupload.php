<?php
    include_once(__DIR__.'/../../models/user.php');
    include_once(__DIR__.'/../../utils.php');

    // If method is POST, process data
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Read and parse csv
        $file = $_FILES['csv']['tmp_name'];
        $data = utils_CsvToArray($file);
        foreach ($data as $i) {
            // For each row generate user and upload to databse
            $user = new User($i);
            print_r($user);
        }
    }
?>