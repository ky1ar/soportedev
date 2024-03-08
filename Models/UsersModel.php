<?php
require_once "config/db.php";
class UsersModel
{
    static public function insertUser($levels, $document, $name, $phone, $email, $password)
    {
        $stmt = ConectionBD::conection()->prepare("INSERT INTO Users (levels, document, name, phone, email, pass) VALUES (:levels, :document, :name, :phone, :email, :password)");

        $stmt->bindParam(":levels", $levels, PDO::PARAM_STR);
        $stmt->bindParam(":document", $document, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    static public function searchByIdUser($document)
    {
        $conn = ConectionBD::conection();
        $stmt = $conn->prepare("SELECT * FROM Users WHERE document = ?");
        $stmt->bindParam(1, $document, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $row = $result[0];
            $row['ky1ar'] = true;
            return $row;
        } else {
            return array('ky1ar' => false);
        }
    }

    static public function list()
    {
        $stmt = ConectionBD::conection()->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
