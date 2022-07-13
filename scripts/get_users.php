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
            $couter = 0;
            foreach ($users as $user) {
                $is_active = $user['is_active'] == 0 ? '' : 'checked';
                $is_administrator = $user['is_adminitrator'] == 0 ? '' : 'checked';

                echo '<tr>' 
                . '<td><input id="user_id" name="user_id" type="hidden" value="' . $user["user_id"] . '"></td>'
                . '<td>' . ++$couter . '</td>'
                . '<td>' . $user['name'] . '</td>'
                . '<td>' . $user['owner'] . '</td>'
                . '<td>' . $user['created_at'] . '</td>'
                . '<td><input type="checkbox" id="is_active" name="is_active"' . $is_active . '></td>'
                . '<td><input type="checkbox" id="is_administrator" name="is_administrator"' . $is_administrator . '></td>'
                . '<td><button type="submit" class="btn-edit"><a href="#">Editar</a></button></td>'
                . '<td><button type="submit" class="btn-cancel"><a href="#">Eliminar</a></button></td>'
                . '</tr>';
            }
        }

        $connection = null;    
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}