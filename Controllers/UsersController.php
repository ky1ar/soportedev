<?php
class UsersController
{
    static public function insertUserController()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $levels = $_POST['levels'];
            $document = $_POST['document'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $response = UsersModel::insertUser($levels, $document, $name, $phone, $email, $password);

            if ($response == "ok") {
                echo "Registro exitoso";
            } else {
                echo "Error en el registro";
            }
        }
    }

    static public function searchByIdUserController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['document'])) {
            $document = $_POST['document'];

            $userData = UsersModel::searchByIdUser($document);

            echo json_encode($userData);
        } else {
            echo json_encode(array('error' => 'Documento no proporcionado'));
        }
    }

    static public function listarController()
    {
        $response = UsersModel::list();
        return $response;
    }
}
