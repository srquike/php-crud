<?php
require_once('../database/connection.php');
require_once('../scripts/get_owners.php');

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
        $user = array(
            "user_id" => $_GET['id'],
            "name" => $_POST['name'],
            "owner_id" => $_POST['owners'],
            "created_at" => $_POST['creation_date'],
            "is_active" => $_POST['activated'] == 'on' ? '1' : 0,
            "is_adminitrator" => $_POST['admin']  == 'on' ? '1' : 0
        );      

        $query = "UPDATE users SET name = :name, owner_id = :owner_id, created_at = :created_at, is_active = :is_active, is_adminitrator = :is_adminitrator WHERE user_id = :user_id;";
        
        $statement = $connection->prepare($query);


        if ($statement->execute($user)) {
            header('Location: ../index.php');
        }

    } catch (Exception $ex) {
        
        $resultado["error"] = true;
        $resultado["mensaje"] = $ex->getMessage();
        $connection = null;
    }
}
?>

<?php
$styles_path = '../styles/custom.css';
$title = 'Editar :: PHP-CRUD';
include_once('../templates/header.php');
?>

<h1>Editar usuario</h1>

<form method="post">
    <div class="input-section">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= $user['name'] ?>" require>
    </div>

    <div class="input-section">
        <label for="owners">Propietario:</label>
        <div>
            <select name="owners" id="owners">            
                <?php
                    $owners = get_owners();
                    if ($owners && count($owners) > 0) {
                        foreach ($owners as $owner) {
                            if ($owner['owner_id'] == $user['owner_id']) {
                                echo '<option value="' . $owner['owner_id'] . '" selected>' . $owner['name'] . '</option>';
                            } else {
                                echo '<option value="' . $owner['owner_id'] . '">' . $owner['name'] . '</option>';
                            }
                        }
                    } else {
                        echo '<option value="none" selected>-- Selecione un propietario --</option>';
                    }                   
                ?>
            </select>
            <button type="submit" class="btn-edit"><a href="../pages/add_owner.php">Agregar propietario</a></button>
        </div>
    </div>

    <div class="input-section">
        <label for="creation_date">Fecha de creaci&oacute;n:</label>
        <input type="date" name="creation_date" id="creation_date" value="<?= $user['created_at'] ?>" require>
    </div>

    <div>
        <label for="activated">Activar usuario</label>
        <input type="checkbox" name="activated" id="activated" <?= $user['is_active'] == 0 ? '' : 'checked' ?>>
    </div>

    <div>
        <label for="admin">Administrador</label>
        <input type="checkbox" name="admin" id="admin" <?= $user['is_adminitrator'] == 0 ? '' : 'checked' ?>>
    </div>

    <div>
        <button type="submit" class="btn-confirm" name="submit">Editar usuario</button>
        <button type="submit" class="btn-cancel"><a href="..\index.php">Cancelar</a></button>
    </div>
</form>

<?php include_once('../templates/footer.php'); ?>