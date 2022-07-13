<?php
require('scripts\get_users.php');

$styles_path = 'styles/custom.css';
$title = 'Inicio :: PHP-CRUD';

include('templates\header.php');
?>

<h1>Usuarios</h1>
<button type="submit" class="btn-confirm "><a href="pages/add.php">Agregar usuario</a></button>
<div>
    <table>
        <thead>
            <th></th>
            <th>#</th>
            <th>Nombre</th>
            <th>Propietario</th>
            <th>Fecha de creaci&oacute;n</th>
            <th>Activo</th>
            <th>Administrador</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $users = get_users();
                if ($users != null) {
                    $couter = 0;
                    foreach ($users as $user) {
                        $is_active = $user['is_active'] == 0 ? '' : 'checked';
                        $is_administrator = $user['is_adminitrator'] == 0 ? '' : 'checked';
                        $user_id = $user["user_id"];
        
                        echo '<tr>' 
                        . '<td><input id="user_id" name="user_id" type="hidden" value="' . $user_id . '"></td>'
                        . '<td>' . ++$couter . '</td>'
                        . '<td>' . $user['name'] . '</td>'
                        . '<td>' . $user['owner'] . '</td>'
                        . '<td>' . $user['created_at'] . '</td>'
                        . '<td><input type="checkbox" id="is_active" name="is_active"' . $is_active . '></td>'
                        . '<td><input type="checkbox" id="is_administrator" name="is_administrator"' . $is_administrator . '></td>'
                        . '<td><button type="submit" class="btn-edit"><a href="scripts/edit_user.php?id=' . $user_id . '">Editar</a></button></td>'
                        . '<td><button type="submit" class="btn-cancel"><a href="scripts/delete_user.php?id=' . $user_id . '">Eliminar</a></button></td>'
                        . '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<?php include('templates\footer.php'); ?>