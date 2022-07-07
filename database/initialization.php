<?php

include('connection.php');

try {

    $connection = get_connection();
    $databaseExistsQuery = 'CREATE DATABASE IF NOT EXISTS php_crud;';

    if ($connection->prepare($databaseExistsQuery)->execute()) {

        $createOwnersTableQuery = 'CREATE TABLE IF NOT EXISTS owners (
            owner_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL);';

        $createUsersTableQuery = 'CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL,
            owner_id INT,
            created_at DATE,
            is_adminitrator BOOLEAN DEFAULT FALSE,
            is_active BOOLEAN DEFAULT FALSE,
            
            FOREIGN KEY(owner_id) REFERENCES owners(owner_id)
            ON UPDATE CASCADE
            ON DELETE CASCADE);';

        $connection->prepare($createOwnersTableQuery)->execute();
        $connection->prepare($createUsersTableQuery)->execute();

        $connection = null;
    }

} catch (Exception $ex) {
    echo $ex->getMessage();
    die();
}