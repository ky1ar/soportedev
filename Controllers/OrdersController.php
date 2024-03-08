<?php
class OrdersController
{

    static public function checkOrderExistenceController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orders'])) {
            $orderNumber = $_POST['orders'];
            $exists = OrdersModel::checkOrderExistence($orderNumber);
            echo json_encode(array('response' => $exists));
        } else {
            echo json_encode(array('error' => 'Número de orden no proporcionado'));
        }
    }

    static public function updateOrderController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['now_ord'])) {
            $now_ord = $_POST['now_ord'];
            $now_stt = $_POST['now_stt'];
            $changer = $_POST['changer'];
            $notes = $_POST['notes'];
            $check = $_POST['check'];

            $response = OrdersModel::updateOrder($now_ord, $now_stt, $changer, $notes, $check);
            echo json_encode($response);
        }
    }

    static public function insertOrderController()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $order = $_POST['order'];
            $document = $_POST['document'];
            $clientID = $_POST['clientID'];
            $client = $_POST['client'];
            $comments = $_POST['comments'];
            $email = $_POST['email'];
            $changer = $_POST['changer'];
            $phone = $_POST['phone'];
            $machine = $_POST['machine'];
            $machineID = $_POST['machineID'];
            $date = $_POST['date'];
            $worker = $_POST['worker'];
            $type = $_POST['type'];
            $origin = $_POST['origin'];

            // Insertar la orden utilizando el modelo
            $result = OrdersModel::insertOrder($order, $document, $client, $comments, $email, $changer, $phone, $machine, $machineID, $date, $worker, $type, $origin);

            if ($result) {
                // La orden se insertó correctamente
                header('Location: grid');
                exit();
            } else {
                // Error al insertar la orden
                echo "Error en la inserción de la orden.";
            }
        }
    }
}
