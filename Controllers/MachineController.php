<?php
class MachineController
{
    static public function searchMachineforModelController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['machine'])) {
            $machine = $_POST['machine'];

            $machineData = MachineModel::searchMachineforModel($machine);

            echo json_encode($machineData);
        } else {
            echo json_encode(array('error' => 'Modelo no proporcionado'));
        }
    }
}
