<?php 

require_once('../database/connection.php');

function get_owners() {
    $query = "SELECT * FROM owners;";
    $connection = get_connection();
    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $owners = $statement->fetchAll();
        return $owners;
    }

    return null;
}