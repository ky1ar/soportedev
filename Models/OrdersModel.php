<?php
require_once "config/db.php";
class OrdersModel
{
    static public function updateOrder($now_ord, $now_stt, $changer, $notes, $check)
    {
        $conn = ConectionBD::conection();
        $now_stt++;

        $sqlUpdate = "UPDATE Orders SET state = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(1, $now_stt, PDO::PARAM_INT);
        $stmtUpdate->bindParam(2, $now_ord, PDO::PARAM_INT);
        $stmtUpdate->execute();

        if ($stmtUpdate->rowCount() > 0) {
            $today = date('Y-m-d H:i:s');

            $sqlInsert = "INSERT INTO Orders_Status (orders, stat, changer, dates, notes) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bindParam(1, $now_ord, PDO::PARAM_INT);
            $stmtInsert->bindParam(2, $now_stt, PDO::PARAM_INT);
            $stmtInsert->bindParam(3, $changer, PDO::PARAM_INT);
            $stmtInsert->bindParam(4, $today, PDO::PARAM_STR);
            $stmtInsert->bindParam(5, $notes, PDO::PARAM_STR);
            $stmtInsert->execute();
            return array("success" => true);
        } else {
            return array("success" => false, "message" => "Orden no encontrada, verifica los datos.");
        }
    }

    static public function insertOrder($order, $document, $client, $comments, $email, $changer, $phone, $machine, $machineID, $date, $worker, $type, $origin)
    {
        $conn = ConectionBD::conection();
        $clientID = null;

        if (empty($clientID)) {
            $sql = "INSERT INTO Users (levels, document, name, nick, role, image, phone, email, pass) VALUES (1, ?, ?, '', '', '', ?, ?, 'password')";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $document, PDO::PARAM_STR);
            $stmt->bindParam(2, $client, PDO::PARAM_STR);
            $stmt->bindParam(3, $phone, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $clientID = $conn->lastInsertId();
            } else {
                return false; // Error in user creation
            }

            $stmt->closeCursor();
        }

        $dateF = date('Y-m-d H:i:s', strtotime($date . ' 00:00:00'));

        $sql = "INSERT INTO Orders (number, machine, client, worker, type, origin, state, comments, dates) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $order, PDO::PARAM_STR);
        $stmt->bindParam(2, $machineID, PDO::PARAM_INT);
        $stmt->bindParam(3, $clientID, PDO::PARAM_INT);
        $stmt->bindParam(4, $worker, PDO::PARAM_INT);
        $stmt->bindParam(5, $type, PDO::PARAM_INT);
        $stmt->bindParam(6, $origin, PDO::PARAM_INT);
        $stmt->bindParam(7, $comments, PDO::PARAM_STR);
        $stmt->bindParam(8, $dateF, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $ordersID = $conn->lastInsertId();

            $stmt->closeCursor();

            $sql = "INSERT INTO Orders_Status (orders, stat, changer, dates ) VALUES (?, 1, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $ordersID, PDO::PARAM_INT);
            $stmt->bindParam(2, $changer, PDO::PARAM_INT);
            $stmt->bindParam(3, $dateF, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->closeCursor();
                $conn = null;
                return true;
            }
        }

        $conn = null;
        return false;
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
