<?php
require_once "Controllers/OrdersController.php";
require_once "Models/OrdersModel.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
</head>

<body>
    <h1>Formulario de Inserción de Orden</h1>
    <form method="post">
        <div>
            <label for="order">Número de Orden:</label>
            <input type="text" id="order" name="order" required>
        </div>
        <div>
            <label for="document">Documento del Cliente:</label>
            <input type="text" id="document" name="document" required>
        </div>
        <div>
            <label for="client">Nombre del Cliente:</label>
            <input type="text" id="client" name="client" required>
        </div>
        <div>
            <label for="comments">Comentarios:</label>
            <textarea id="comments" name="comments"></textarea>
        </div>
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="changer">Changer:</label>
            <input type="text" id="changer" name="changer" required>
        </div>
        <div>
            <label for="phone">Teléfono del Cliente:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div>
            <label for="machine">Máquina:</label>
            <input type="text" id="machine" name="machine" required>
        </div>
        <div>
            <label for="machineID">ID de la Máquina:</label>
            <input type="text" id="machineID" name="machineID" required>
        </div>
        <div>
            <label for="date">Fecha:</label>
            <input type="datetime-local" id="date" name="date" required>
        </div>
        <div>
            <label for="worker">ID del Técnico:</label>
            <input type="text" id="worker" name="worker" required>
        </div>
        <div>
            <label for="type">ID del Tipo de Orden:</label>
            <input type="text" id="type" name="type" required>
        </div>
        <div>
            <label for="origin">ID del Origen:</label>
            <input type="text" id="origin" name="origin" required>
        </div>
        <div>
            <button type="submit" name="submit">Insertar Orden</button>
        </div>
        <?php
        $insertar = new OrdersController();
        $insertar->insertOrderController();
        ?>
    </form>

</body>

</html>