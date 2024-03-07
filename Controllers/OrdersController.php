<?php
class OrdersController
{

    static public function checkOrderExistenceController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orders'])) {
            $orderNumber = $_POST['orders'];
            $exists = OrdersModel::checkOrderExistence($orderNumber);

            // Devolver la respuesta en formato JSON
            echo json_encode(array('response' => $exists));
        } else {
            echo json_encode(array('error' => 'Número de orden no proporcionado'));
        }
    }
}
