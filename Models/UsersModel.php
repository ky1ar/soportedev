<?php
require_once "çonfig/db.php";
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
}
