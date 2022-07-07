<?php
require_once('..\scripts\add_user.php');

$styles_path = '../styles/custom.css';
$title = 'Agregar usuario :: PHP-CRUD';

include_once('..\templates\header.php');
?>

<h1>Agregar usuario</h1>

<form method="post">
    <div class="input-section">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="srquike" require>
    </div>

    <div class="input-section">
            <label for="owners">Propietario:</label>
            <div>
                <select name="owners" id="owners">
                    <option value="none" selected>-- Selecione un propietario --</option>
                    <?php get_owners(); ?>
                </select>
                <button type="submit" class="btn-edit"><a href="add_owner.php">Agregar propietario</a></button>
            </div>
    </div>

    <div class="input-section">
        <label for="creation_date">Fecha de creaci&oacute;n:</label>
        <input type="date" name="creation_date" id="creation_date" require>
    </div>

    <div>
        <label for="activated">Activar usuario</label>
        <input type="checkbox" name="activated" id="activated">
    </div>

    <div>
        <label for="admin">Administrador</label>
        <input type="checkbox" name="admin" id="admin">
    </div>

    <div>
        <button type="submit" class="btn-confirm" name="submit">Agregar usuario</button>
        <button type="submit" class="btn-cancel"><a href="..\index.php">Cancelar</a></button>
    </div>
</form>

<?php include_once('..\templates\footer.php'); ?>