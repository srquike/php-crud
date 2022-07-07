<?php
require_once('..\database\connection.php');

add_owner();

function add_owner() {
    if (isset($_POST['submit'])) {

        $resultado = [
            'error' => false,
            'mensaje' => 'El propietario ' . $_POST['name'] . ' ha sido agregado con éxito' 
        ];
    
        try {
            $connection = get_connection();  
            $owner = array(
                "name" => $_POST['name']
            );       
            $query = "INSERT INTO owners (name)" 
                        . "VALUES(:" . implode(", :", array_keys($owner)) . ")";
            
            $connection->prepare($query)->execute($owner);
            $connection = null;
    
        } catch (Exception $ex) {
            
            $resultado["error"] = true;
            $resultado["mensaje"] = $ex->getMessage();
            $connection = null;
            die();
        }
    }
}
?>

<?php 
$styles_path = '../styles/custom.css';
$title = 'Agregar propietario :: PHP-CRUD';

include_once('..\templates\header.php');
?>

<h1>Agregar propietario</h1>

<form method="post">
    <div class="input-section">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="srquike" require>
    </div>

    <div>
        <button type="submit" class="btn-confirm" name="submit">Agregar propietario</button>
        <button type="button" class="btn-cancel"><a href="add.php">Cancelar</a></button>
    </div>
</form>

<?php include_once('..\templates\footer.php'); ?>