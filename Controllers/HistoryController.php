<?php
class HistoryController
{
    static public function insertHistoryController($orders, $document)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($orders, $document)) {
            $conn = ConectionBD::conection();

            if ($conn) {
                $sql = "SELECT o.id FROM Orders o INNER JOIN Users c ON o.client = c.id WHERE o.number = ? AND c.document = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $orders, PDO::PARAM_STR);
                $stmt->bindParam(2, $document, PDO::PARAM_STR);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $agent = $_SERVER['HTTP_USER_AGENT'];

                    $ipReadable = inet_ntop(inet_pton($ip));
                    $ipv4 = null;
                    if (filter_var($ipReadable, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                        $ipv4 = $ipReadable;
                    } elseif (filter_var($ipReadable, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                        $ipv4 = inet_ntop(substr(inet_pton($ipReadable), 12));
                    }

                    // Llamada a la función del modelo
                    $result = HistoryModel::insertHistory($result['id'], $ipv4, $agent);

                    if ($result) {
                        echo json_encode(array("success" => true));
                        exit();
                    } else {
                        echo json_encode(array("success" => false, "message" => "Error en la inserción del historial."));
                        exit();
                    }
                } else {
                    echo json_encode(array("success" => false, "message" => "Orden no encontrada, verifica los datos."));
                    exit();
                }
                $stmt->closeCursor();
                $conn = null;
            } else {
                echo json_encode(array("success" => false, "message" => "Error en la conexión a la base de datos."));
                exit();
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Datos incompletos."));
            exit();
        }
    }
}
