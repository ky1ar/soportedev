<?php
require_once "Controllers/HistoryController.php";
require_once "Models/HistoryModel.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>

<body>
    <h1>Pruebas</h1>
    <form method="post">
        <div>
            <label for="orders">Número de Orden:</label>
            <input type="text" id="orders" name="orders" required>
        </div>
        <div>
            <label for="document">Documento del Cliente:</label>
            <input type="text" id="document" name="document" required>
        </div>
        <div>
            <button type="submit">Buscar</button>
        </div>
        <?php
        $test = new HistoryController();
        $test->insertHistoryController($_POST['orders'], $_POST['document']);
        ?>
    </form>

</body>

</html>
