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
            <?php get_users(); ?>
        </tbody>
    </table>
</div>

<?php include('templates\footer.php'); ?>