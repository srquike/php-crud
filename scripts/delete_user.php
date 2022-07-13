<?php
require_once('../database/connection.php');

$user = [];
$connection = get_connection();

if (isset($_GET['id'])) {

    $query = "SELECT * FROM users WHERE user_id = ?;";    
    $statement = $connection->prepare($query);

    if ($statement->execute(array($_GET['id']))) {
        $results = $statement->fetchAll();

        if ($results && $statement->rowCount() > 0) {
            $user = $results[0];
        } else {
            echo "El usuario no existe!";
        }
    }
}

if (isset($_POST['submit'])) {
    try {   
        $query = "DELETE FROM users WHERE user_id = ?;";        
        $statement = $connection->prepare($query);

        if ($statement->execute(array($_GET['id']))) { 
            header('Location: ../index.php');
        }

        $connection = null;

    } catch (Exception $ex) {
        
        $connection = null;
    }
}
?>

<?php
$styles_path = '../styles/custom.css';
$title = 'Eliminar :: PHP-CRUD';
include_once('../templates/header.php');
?>

<h1>Eliminar usuario</h1>
<h2>¿Est&aacute; seguro de que desea eliminar al usuario?</h2>

<form method="post">
    <div class="input-section">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= $user['name'] ?>" readonly>
    </div>
    <div>
        <button type="submit" class="btn-cancel" name="submit">Eliminar usuario</button>
        <button type="submit" class="btn-confirm"><a href="..\index.php">Cancelar</a></button>
    </div>
</form>

<?php include_once('../templates/footer.php'); ?>