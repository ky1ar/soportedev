<?php
require_once "çonfig/db.php";
class OrdersModel
{
    static public function updateOrder()
    {
    }

    static public function insertOrder()
    {
    }

    static public function checkOrderExistence($orderNumber)
    {
        $conn = ConectionBD::conection();
        
        $stmt = $conn->prepare("SELECT id FROM Orders WHERE number = :orderNumber");
        $stmt->bindParam(':orderNumber', $orderNumber, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exists = !empty($result);

        return $exists;
    }
}
