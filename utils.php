<?php

    function utils_CsvToArray($file){
        /* Map Rows and Loop Through Them */
        $rows   = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        $csv    = array();
        foreach($rows as $row) {
            $csv[] = array_combine($header, $row);
        }
        return $csv;
    }

?>