<?php
require_once('..\database\connection.php');

add_user();

function get_owners() {
    $connection = get_connection();
    $query = 'SELECT * FROM owners;';
    $statement = $connection->prepare($query);
    $statement->execute();
    $owners = $statement->fetchAll();

    if ($owners && $statement->rowCount() > 0) {    
        foreach ($owners as $owner) {
            echo '<option value="' . $owner['owner_id'] . '">' . $owner['name'] . '</option>';
        }
    }

    $connection = null;
}

function add_user() {
    if (isset($_POST['submit'])) {

        $resultado = [
            'error' => false,
            'mensaje' => 'El usuario ' . $_POST['name'] . ' ha sido agregado con éxito' 
        ];
    
        try {
            $connection = get_connection();  
            $user = array(
                "name" => $_POST['name'],
                "owner_id" => $_POST['owners'],
                "created_at" => $_POST['creation_date'],
                "is_active" => $_POST['activated'] == 'on' ? '1' : 0,
                "is_adminitrator" => $_POST['admin']  == 'on' ? '1' : 0
            );       
            $query = "INSERT INTO users (name, owner_id, created_at, is_active, is_adminitrator)" 
                        . "VALUES(:" . implode(", :", array_keys($user)) . ")";
            
            if ($sentence = $connection->prepare($query)->execute($user)) {
                $connection = null;
            }
    
        } catch (Exception $ex) {
            
            $resultado["error"] = true;
            $resultado["mensaje"] = $ex->getMessage();
            $connection = null;
        }
    }
} 