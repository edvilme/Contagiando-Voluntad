<?php
    require_once 'vendor/autoload.php';

    $servername = "contagiandovoluntad.org";
    $username = "contagi1_db_admin";
    $password = "m3p9V1hH7t.";
    $database = "contagi1_mexicanos_ejemplares";
    // Create connection using PDO
    $database = new PDO('mysql:host='.$servername.';dbname='.$database.';charset=utf8', $username, $password);
    // Use this to build queries
    $query = new \ClanCats\Hydrahon\Builder('mysql', function ($query, $queryString, $queryParameters) use ($database){
        $statement = $database->prepare($queryString);
        $statement->execute($queryParameters);

        // when the query is fetchable return all results and let hydrahon do the rest
        // (there's no results to be fetched for an update-query for example)
        if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
        {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        // when the query is a instance of a insert return the last inserted id  
        elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
        {
            return $database->lastInsertId();
        }
        // when the query is not a instance of insert or fetchable then
        // return the number os rows affected
        else 
        {
            return $statement->rowCount();
        } 
    })
?>