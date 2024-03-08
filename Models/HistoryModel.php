<?php
require_once "config/db.php";
class HistoryModel
{
    static public function insertHistory($orderId, $ip, $agent)
    {
        $conn = ConectionBD::conection();

        $ipReadable = inet_ntop(inet_pton($ip));
        $ipv4 = null;

        if (filter_var($ipReadable, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $ipv4 = $ipReadable;
        } elseif (filter_var($ipReadable, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ipv4 = inet_ntop(substr(inet_pton($ipReadable), 12));
        }

        $sql = "INSERT INTO History (orders, actions, ip, agent) VALUES (?, 3, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bindParam(1, $orderId, PDO::PARAM_INT);
            $stmt->bindParam(2, $ipv4, PDO::PARAM_STR);
            $stmt->bindParam(3, $agent, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }
}
