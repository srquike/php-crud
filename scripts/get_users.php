<?php
require_once('database\connection.php');

function get_users() {   
    try {
        $connection = get_connection();
        $query = 'SELECT users.*, owners.name AS owner FROM users INNER JOIN owners USING(owner_id);';
        $statement = $connection->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();

        if ($users && $statement->rowCount() > 0) {    
            return $users;
        }

        $connection = null;    
        return null;
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $connection = null;  
        die();
    }
}