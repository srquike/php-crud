<?php

define('USER', 'jonathan');
define('DATABASE', 'php_crud');
define('HOST','localhost');
define('PASSWORD','');

function get_connection() {

    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER, PASSWORD);
    return $db;
}