<?php
class ConectionBD{
    static public function conection(){
        $conn = new PDO("mysql:host=localhost;dbname=u809802095_support","root","");
        $conn->exec("set names utf8");
        return $conn;
    }
}
?>
