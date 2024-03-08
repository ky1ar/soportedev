<?php
require_once "config/db.php";
class MachineModel
{
    static public function searchMachineforModel($machine)
    {
        $conn = ConectionBD::conection();

        $sql = "SELECT * FROM Machine WHERE model LIKE :machine";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':machine', $machine, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();
        $stmt = null;

        return $result;
    }
}
